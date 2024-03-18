<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint\SpaceGroup;

use AdroSoftware\CircleSoSdk\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class SpaceGroupTest extends TestCase
{
    public function test_it_can_get_space_groups()
    {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('space_groups')),
        ]);

        $spaceGroups = $sdk->spaceGroups()
            ->communityId(1)
            ->spaceGroups();

        $this->assertIsArray($spaceGroups);

        $spaceGroupOne = $spaceGroups[0];
        $spaceGroupTwo = $spaceGroups[1];
        $spaceGroupThree = $spaceGroups[2];

        $this->assertArrayHasKey('id', $spaceGroupOne);

        $this->assertSame(1, $spaceGroupOne['id']);
        $this->assertSame(2, $spaceGroupTwo['id']);
        $this->assertSame('space-group-three', $spaceGroupThree['slug']);
    }

    public function test_it_can_get_a_space_group()
    {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('space_group')),
        ]);

        $spaceGroup = $sdk->spaceGroups()
            ->communityId(1)
            ->show(1);

        $this->assertIsArray($spaceGroup);

        $this->assertSame(1, $spaceGroup['id']);
        $this->assertSame('space-group-one', $spaceGroup['slug']);
    }

    public function test_it_can_create_a_space_group()
    {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('space_group_create')),
        ]);

        $spaceGroupResponse = $sdk->spaceGroups()
            ->communityId(1)
            ->create([
                'name' => 'Awesome Space Group',
                'slug' => 'awesome-space-group',
            ]);

        $this->assertIsArray($spaceGroupResponse);

        $spaceGroup = $spaceGroupResponse['space_group'];

        $this->assertSame(4, $spaceGroup['id']);
        $this->assertSame('awesome-space-group', $spaceGroup['slug']);
    }

    public function test_it_can_update_a_space_group()
    {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('space_group_update')),
        ]);

        $spaceGroupResponse = $sdk->spaceGroups()
            ->communityId(1)
            ->update(4, [
                'name' => 'Awesome Space Group',
                'slug' => 'awesome-space-group',
            ]);

        $this->assertIsArray($spaceGroupResponse);

        $spaceGroup = $spaceGroupResponse['space_group'];

        $this->assertSame(4, $spaceGroup['id']);
        $this->assertSame('awesome-space-group', $spaceGroup['slug']);
    }

    public function test_it_can_delete_a_space_group()
    {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response('space_group_delete')),
        ]);

        $spaceGroupResponse = $sdk->spaceGroups()
            ->communityId(1)
            ->delete(4);

        $this->assertIsArray($spaceGroupResponse);

        $this->assertSame('The space group has been removed from the community', $spaceGroupResponse['message']);
        $this->assertTrue($spaceGroupResponse['success']);
    }
}
