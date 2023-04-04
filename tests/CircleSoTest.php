<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    RequestUnauthorizedException,
    UnsuccessfulResponseException,
};
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

    public function test_community_members_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('community_members')),
        ]);

        $communityMembers = $circleSo->members()
            ->communityId(1)
            ->communityMembers(perPage: 2);

        $this->assertCount(2, $communityMembers);

        $this->assertSame(1, $communityMembers[0]['id']);
        $this->assertSame('Adro', $communityMembers[0]['first_name']);
        $this->assertSame('Adro Morelos', $communityMembers[0]['name']);
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

    public function test_member_tags_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_tags')),
        ]);

        $memberTags = $circleSo->memberTags()
            ->communityId(1)
            ->memberTags();

        $this->assertArrayHasKey('id', $memberTags[0]);

        $this->assertSame(12345, $memberTags[0]['id']);
        $this->assertSame("Rock n' Roll", $memberTags[0]['name']);
    }

    public function test_member_tag_show_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('member_tag')),
        ]);

        $memberTag = $circleSo->memberTags()
            ->communityId(1)
            ->show(12345);

        $this->assertArrayHasKey('id', $memberTag);

        $this->assertSame(12345, $memberTag['id']);
        $this->assertSame("Rock n' Roll", $memberTag['name']);
    }
}
