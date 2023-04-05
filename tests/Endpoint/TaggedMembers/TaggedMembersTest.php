<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint\MemberTag;

use AdroSoftware\CircleSoSdk\Exception\{
    UnsuccessfulResponseException,
};
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class TaggedMembersTest extends TestCase
{
    public function test_tag_member_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('success_true')),
        ]);

        $response = $circleSo->taggedMembers()
            ->tagMember('adro@example.com', 123456);

        $this->assertArrayHasKey('success', $response);

        $this->assertSame(true, $response['success']);
    }

    public function test_tag_member_array_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('success_true')),
        ]);

        $response = $circleSo->taggedMembers()
            ->tagMember(['adro@example.com', 'morelos@example.com'], 123456);

        $this->assertArrayHasKey('success', $response);

        $this->assertSame(true, $response['success']);
    }

    public function test_untag_member_ok(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('untag_member')),
        ]);

        $response = $circleSo->taggedMembers()
            ->untagMember('adro@example.com', 123456, 1);

        $this->assertArrayHasKey('success', $response);

        $this->assertSame(true, $response['success']);
    }

    public function test_tag_member_failed_no_message(): void
    {
        $this->expectException(UnsuccessfulResponseException::class);
        $this->expectExceptionMessage('The request did not return a successful response.');
        $this->expectExceptionCode(500);

        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('success_false')),
        ]);

        $response = $circleSo->taggedMembers()
            ->tagMember('adro@example.com', 123456);

        $this->assertArrayHasKey('success', $response);

        $this->assertSame(false, $response['success']);
    }
}
