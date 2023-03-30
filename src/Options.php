<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Http\Message\ResponseMediator;
use AdroSoftware\CircleSoSdk\Http\Message\ResponseMediatorInterface;
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
            'response_mediator' => new ResponseMediator(),
            'uri' => 'https://app.circle.so/api/',
            'version' => 'v1',
            'user_agent' => 'AdroSoftware/CircleSoSdk',
        ]);

        $resolver->setAllowedTypes('uri', 'string');
        $resolver->setAllowedTypes('version', 'string');
        $resolver->setAllowedTypes('user_agent', 'string');
        $resolver->setAllowedTypes('client_builder', ClientBuilder::class);
        $resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
        $resolver->setAllowedTypes('response_mediator', ResponseMediatorInterface::class);
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->options['client_builder'];
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    public function getResponseMediator(): ResponseMediatorInterface
    {
        return $this->options['response_mediator'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()
            ->createUri($this->options['uri'] . "{$this->getVersion()}/");
    }

    public function getVersion(): string
    {
        return $this->options['version'];
    }

    public function getUserAgent(): string
    {
        return $this->options['user_agent'];
    }
}
