<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\ClientBuilder;
use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
};
use AdroSoftware\CircleSoSdk\Options;
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use GuzzleHttp\Psr7\Response;

final class CircleSoTest extends TestCase
{
    public function test_circle_so_sdk_instance(): void
    {
        $this->assertInstanceOf(
            CircleSo::class,
            $this->getSdkWithMockedClient()
        );
    }

    public function test_community_id_not_set(): void
    {
        $this->expectException(CommunityIdNotPresentException::class);
        $this->expectExceptionMessage("The 'communityId' needs to be defined");
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_update_failed')),
        ]);

        $circleSo->members()
            ->update(
                id: 000000,
                data: ['first_name' => 'Adroeck'],
            );
    }

    public function test_endpoint_requests_use_the_configured_response_factory(): void
    {
        $factory = new class implements FactoryInterface {
            public function factor(?array $response = null): object
            {
                return (object) $response;
            }
        };
        $circleSo = CircleSo::make('token', new Options([
            'client_builder' => new ClientBuilder($this->mockedClient([
                new Response(200, [], '{"records":[]}'),
            ])),
            'response_factory' => $factory,
        ]));

        $response = $circleSo->posts()->all(spaceId: 1, communityId: 2);

        $this->assertIsObject($response);
        $this->assertSame([], $response->records);
    }
}
