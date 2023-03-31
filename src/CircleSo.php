<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Endpoint\{
    Me\Me,
    Member\Members,
};
use AdroSoftware\CircleSoSdk\Http\Message\ArrayTransformer;
use AdroSoftware\CircleSoSdk\Http\Message\ResponseTransformerInterface;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Psr\Http\Message\ResponseInterface;

final class CircleSo
{
    private ?ClientBuilder $clientBuilder = null;

    private ?FactoryInterface $responseFactory = null;

    private ?ResponseTransformerInterface $responseTransformer = null;

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
        $options = $options ?? new Options();

        $this->responseTransformer = new ArrayTransformer();
        $this->responseFactory = $options->getResponseFactory();

        $this->clientBuilder = $options->getClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($options->getUri()));
        $this->clientBuilder->addPlugin(
            new HeaderDefaultsPlugin(
                [
                    'User-Agent' => $options->getUserAgent(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => "Token {$token}",
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

    public function factorResponse(ResponseInterface $response): mixed
    {
        if ($this->responseFactory instanceof FactoryInterface) {
            return $this->responseFactory->factor(
                $this->responseTransformer->transform($response)
            );
        }

        return  $this->responseTransformer->transform($response);
    }
}
