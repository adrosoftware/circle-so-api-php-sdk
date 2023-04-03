<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Endpoint\{
    Me\Me,
    Member\Members,
};
use AdroSoftware\CircleSoSdk\Exception\RequestUnauthorizedException;
use AdroSoftware\CircleSoSdk\Exception\UnsuccessfulResponseException;
use AdroSoftware\CircleSoSdk\Http\Message\ArrayTransformer;
use AdroSoftware\CircleSoSdk\Http\Message\ResponseTransformerInterface;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use AdroSoftware\CircleSoSdk\Response\Status;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Psr\Http\Message\ResponseInterface;

final class CircleSo
{
    private ClientBuilder $clientBuilder;

    private FactoryInterface $responseFactory;

    private ResponseTransformerInterface $responseTransformer;

    public static function make(
        string $token,
        ?Options $options = null,
    ): static {
        return new static($token, $options);
    }

    public function __construct(
        private string $token,
        private ?Options $options = null,
    ) {
        $this->options = $options ?? new Options();

        $this->responseTransformer = new ArrayTransformer();
        $this->responseFactory = $this->options->getResponseFactory();

        $this->clientBuilder = $this->options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($this->options->getUri()));
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => $this->options->getUserAgent(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => "Token {$this->token}",
                ]
            )
        );
    }

    public function me(): Me
    {
        return new Me($this);
    }

    public function members(): Members
    {
        return new Members($this);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    public function getResponseTransformer(): ResponseTransformerInterface
    {
        return $this->responseTransformer;
    }

    public function getResponseFactory(): FactoryInterface
    {
        return $this->responseFactory;
    }

    public function factorResponse(ResponseInterface $response): mixed
    {
        $response = $this->getResponseTransformer()->transform($response);

        $this->checkIfRequestWasSuccessful($response);

        if ($this->getResponseFactory() instanceof FactoryInterface) {
            $response = $this->getResponseFactory()->factor($response);
        }

        return $response;
    }

    protected function checkIfRequestWasSuccessful(array $response): void
    {
        if (isset($response['status']) && $response['status'] === Status::UNAUTHORIZED) {
            $message  = isset($response['message']) ? $response['message'] : "The request was not authorized.";

            throw new RequestUnauthorizedException($message, 500);
        }

        if (isset($response['success']) && boolval($response['success']) === false) {
            $message  = isset($response['message']) ?
                $response['message'] :
                "The request did not return a successful response.";

            throw new UnsuccessfulResponseException($message, 500);
        }
    }
}
