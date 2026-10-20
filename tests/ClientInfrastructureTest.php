<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\{
    AdminV2,
    ClientBuilder,
    HeadlessAuth,
    HeadlessMember,
    Options,
};
use AdroSoftware\CircleSoSdk\Endpoint\RawEndpoint;
use GuzzleHttp\Psr7\HttpFactory;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

final class ClientInfrastructureTest extends TestCase
{
    public function test_client_builder_accepts_global_plugins(): void
    {
        $factory = new HttpFactory();
        $builder = new ClientBuilder($this->mockedClient(), $factory, $factory);

        $builder->addPlugin(new HeaderDefaultsPlugin(['X-Test' => 'enabled']));

        self::assertNotNull($builder->getHttpClient());
    }

    public function test_versioned_clients_expose_raw_endpoints(): void
    {
        $options = new Options([
            'client_builder' => new ClientBuilder($this->mockedClient()),
        ]);

        self::assertInstanceOf(RawEndpoint::class, AdminV2::make('secret', $options)->raw());
        self::assertInstanceOf(RawEndpoint::class, HeadlessAuth::make('secret', $options)->raw());
        self::assertInstanceOf(RawEndpoint::class, HeadlessMember::make('secret', $options)->raw());
    }

    public function test_raw_endpoint_rejects_unsupported_http_methods(): void
    {
        $admin = AdminV2::make('secret', new Options([
            'client_builder' => new ClientBuilder($this->mockedClient()),
        ]));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported HTTP method: TRACE');

        $admin->raw()->call('TRACE', '/diagnostics');
    }
}
