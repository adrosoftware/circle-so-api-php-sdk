<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Exception\{
    RequestUnauthorizedException,
    UnsuccessfulResponseException
};
use AdroSoftware\CircleSoSdk\Http\Message\ArrayTransformer;
use AdroSoftware\CircleSoSdk\Http\Message\ResponseTransformerInterface;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use AdroSoftware\CircleSoSdk\Response\Status;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient
{
    protected ClientBuilder $clientBuilder;

    protected FactoryInterface $responseFactory;

    protected ResponseTransformerInterface $responseTransformer;

    public function __construct(
        protected string $token,
        protected ?Options $options = null,
    ) {
        $this->options = $options ?? new Options();

        $this->responseTransformer = new ArrayTransformer();
        $this->responseFactory = $this->options->getResponseFactory();

        $this->clientBuilder = $this->options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($this->options->getUri()));
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => $this->options->getUserAgent(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Token {$this->token}",
            ])
        );
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

            throw new RequestUnauthorizedException($message);
        }

        if (isset($response['success']) && boolval($response['success']) === false) {
            $message  = isset($response['message']) ?
                $response['message'] :
                "The request did not return a successful response.";

            throw new UnsuccessfulResponseException($message);
        }
    }
}
