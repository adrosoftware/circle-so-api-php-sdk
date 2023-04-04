<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
};
use AdroSoftware\CircleSoSdk\Tests\Traits\{
    Me,
    Members,
    MemberTags,
    SdkInstance,
};
use GuzzleHttp\Psr7\Response;

final class CircleSoTest extends TestCase
{
    use SdkInstance;
    use Me;
    use Members;
    use MemberTags;

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
}
