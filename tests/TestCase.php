<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\ClientBuilder;
use AdroSoftware\CircleSoSdk\Options;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Psr\Http\Client\ClientInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function sdk(ClientInterface $client): CircleSo
    {
        return new CircleSo(
            '5up3r53cr3770k3n',
            new Options([
                'client_builder' => new ClientBuilder($client),
            ])
        );
    }

    protected function mockedClient(array $responses = []): ClientInterface
    {
        $mock = new MockHandler($responses);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }

    protected function getSdkWithMockedClient(array $responses = []): CircleSo
    {
        return $this->sdk(
            $this->mockedClient($responses)
        );
    }
}