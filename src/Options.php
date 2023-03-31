<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Response\BypassFactory;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class Options
{
    public function __construct(private array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'client_builder' => new ClientBuilder(),
            'uri_factory' => Psr17FactoryDiscovery::findUriFactory(),
            'response_factory' => new BypassFactory(),
            'uri' => 'https://app.circle.so/api/',
            'api_version' => 'v1',
            'user_agent' => 'adrosoftware/circle-so-api-php-sdk',
        ]);

        $resolver->setAllowedTypes('uri', 'string');
        $resolver->setAllowedTypes('api_version', 'string');
        $resolver->setAllowedTypes('user_agent', 'string');
        $resolver->setAllowedTypes('client_builder', ClientBuilder::class);
        $resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
        $resolver->setAllowedTypes('response_factory', FactoryInterface::class);
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'];
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    public function getResponseFactory(): ?FactoryInterface
    {
        return $this->options['response_factory'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()
            ->createUri($this->options['uri'] . "{$this->getApiVersion()}/");
    }

    public function getApiVersion(): string
    {
        return $this->options['api_version'];
    }

    public function getUserAgent(): string
    {
        return $this->options['user_agent'];
    }
}
