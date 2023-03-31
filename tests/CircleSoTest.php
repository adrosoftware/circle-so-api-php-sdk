<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;
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

    public function test_get_me(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('me')),
        ]);

        $me = $circleSo->me()->info();

        $this->assertArrayHasKey('id', $me);

        $this->assertSame(1, $me['id']);
        $this->assertSame('Adro', $me['first_name']);
    }

    public function test_member_search_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member')),
        ]);

        $member = $circleSo->members()
            ->search('adro@example.com', 1);

        $this->assertArrayHasKey('id', $member);

        $this->assertSame(1, $member['id']);
        $this->assertSame('Adro', $member['first_name']);
        $this->assertSame('Adro Morelos', $member['name']);
    }

    public function test_member_show_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member')),
        ]);

        $member = $circleSo->members()
            ->communityId(1)
            ->show(1);

        $this->assertArrayHasKey('id', $member);

        $this->assertSame(1, $member['id']);
        $this->assertSame('Adro', $member['first_name']);
        $this->assertSame('Adro Morelos', $member['name']);
    }
}
