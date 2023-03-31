<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Exception\RequestUnauthorizedException;
use AdroSoftware\CircleSoSdk\Exception\UnsuccessfulResponseException;
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

    public function test_get_me_not_authorized(): void
    {
        $this->expectException(RequestUnauthorizedException::class);
        $this->expectExceptionMessage('Your account could not be authenticated.');
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('unauthorized')),
        ]);

        $circleSo->me()->info();
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

    public function test_member_show_failed(): void
    {
        $this->expectException(UnsuccessfulResponseException::class);
        $this->expectExceptionMessage('Could not find CommunityMember record with ID 000000');
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_update_failed')),
        ]);

        $circleSo->members()
            ->communityId(1)
            ->show(000000);
    }

    public function test_member_update_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_updated')),
        ]);

        $memberUpdated = $circleSo->members()
            ->communityId(1)
            ->update(
                id: 1,
                data: ['first_name' => 'Adroeck'],
                spaceIds: [1,2,3,],
                spaceGroupIds: [1,2,3,],
                skipInvitation: true
            );

        $this->assertArrayHasKey('community_member', $memberUpdated);

        $this->assertSame(true, $memberUpdated['success']);
        $this->assertSame(1, $memberUpdated['community_member']['id']);
        $this->assertSame('Adroeck', $memberUpdated['community_member']['first_name']);
        $this->assertSame('Adroeck Morelos', $memberUpdated['community_member']['name']);
    }


    public function test_member_update_failed(): void
    {
        $this->expectException(UnsuccessfulResponseException::class);
        $this->expectExceptionMessage('Could not find CommunityMember record with ID 000000');
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_update_failed')),
        ]);

        $circleSo->members()
            ->communityId(1)
            ->update(
                id: 000000,
                data: ['first_name' => 'Adroeck'],
            );
    }
}
