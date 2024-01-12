<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint\Community;

use AdroSoftware\CircleSoSdk\Exception\{
    ResourceNotFoundException,
    UnsuccessfulResponseException,
};
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class CommunitiesTest extends TestCase
{
    public function test_get_communities(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('communities')),
        ]);

        $communities = $circleSo->communities()->all();

        $this->assertArrayHasKey('id', $communities[0]);

        $this->assertSame(1, $communities[0]['id']);
        $this->assertSame('Test community', $communities[0]['name']);
        $this->assertSame('test-community', $communities[0]['slug']);
    }

    public function test_get_community_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('community')),
        ]);

        $community = $circleSo->communities()
            ->communityId(1)
            ->community('test-community');

        $this->assertArrayHasKey('id', $community);

        $this->assertSame(1, $community['id']);
        $this->assertSame('Test community', $community['name']);
        $this->assertSame('test-community', $community['slug']);
    }

    public function test_get_community_empty(): void
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->expectExceptionMessage('The resource was not found.');
        $this->expectExceptionCode(404);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], null),
        ]);

        $circleSo->communities()
            ->communityId(1)
            ->community('non-existent-community');

    }
}
