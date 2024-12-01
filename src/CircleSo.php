<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Contracts\InteractsWithEndpoints;
use AdroSoftware\CircleSoSdk\Endpoint\{
    Community\Communities,
    Course\Courses,
    Me\Me,
    Member\Members,
    MemberTag\MemberTag,
    Space\Spaces,
    SpaceGroup\SpaceGroups,
    TaggedMembers\TaggedMembers,
};

final class CircleSo extends AbstractClient implements InteractsWithEndpoints
{
    public static function make(
        string $token,
        ?Options $options = null,
    ): static {
        return new static($token, $options);
    }

    public function me(): Me
    {
        return new Me($this);
    }

    public function communities(): Communities
    {
        return new Communities($this);
    }

    public function courses(): Courses
    {
        return new Courses($this);
    }

    public function members(): Members
    {
        return new Members($this);
    }

    public function memberTags(): MemberTag
    {
        return new MemberTag($this);
    }

    public function spaces(): Spaces
    {
        return new Spaces($this);
    }

    public function spaceGroups(): SpaceGroups
    {
        return new SpaceGroups($this);
    }

    public function taggedMembers(): TaggedMembers
    {
        return new TaggedMembers($this);
    }
}
