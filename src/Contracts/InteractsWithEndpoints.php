<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Contracts;

use AdroSoftware\CircleSoSdk\Endpoint\{
    Community\Communities,
    Me\Me,
    Member\Members,
    MemberTag\MemberTag,
    TaggedMembers\TaggedMembers,
};

interface InteractsWithEndpoints
{
    public function me(): Me;

    public function communities(): Communities;

    public function members(): Members;

    public function memberTags(): MemberTag;

    public function taggedMembers(): TaggedMembers;
}
