<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Traits;

use GuzzleHttp\Psr7\Response;

trait MemberTags
{
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
