<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use Closure;
use GuzzleHttp\Psr7\Response;

final class V1ResponseFixtureTest extends TestCase
{
    /** @dataProvider responseProvider */
    public function test_endpoint_transforms_response_fixture(
        string $fixture,
        Closure $call,
        array $path,
        mixed $expected,
    ): void {
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], json_response($fixture)),
        ]);

        $value = $call($sdk);

        foreach ($path as $key) {
            $this->assertIsArray($value);
            $this->assertArrayHasKey($key, $value);
            $value = $value[$key];
        }

        $this->assertSame($expected, $value);
    }

    /**
     * @return iterable<string, array{string, Closure(CircleSo): mixed, array<int|string>, mixed}>
     */
    public static function responseProvider(): iterable
    {
        yield 'space group member' => [
            'space_group_member',
            static fn (CircleSo $sdk): mixed => $sdk->spaceGroupMembers()->show('member@example.com', 12, 5),
            ['status'],
            'active',
        ];
        yield 'space member mutation' => [
            'success_true',
            static fn (CircleSo $sdk): mixed => $sdk->spaceMembers()->add('member@example.com', 12, 5),
            ['success'],
            true,
        ];
        yield 'spaces' => [
            'spaces',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->spaces(5),
            [0, 'name'],
            'General',
        ];
        yield 'posts' => [
            'posts',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->all(12, 5),
            [0, 'body'],
            'Welcome to the community',
        ];
        yield 'comments' => [
            'comments',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->all(5, postId: 21),
            [0, 'likes_count'],
            1,
        ];
        yield 'tagged members' => [
            'tagged_members',
            static fn (CircleSo $sdk): mixed => $sdk->taggedMembers()->all(),
            [0, 'member_tag_name'],
            "Rock n' Roll",
        ];
        yield 'messages' => [
            'message',
            static fn (CircleSo $sdk): mixed => $sdk->messages()->direct('member@example.com', 'Hello', 5),
            ['chat_room_message', 'body'],
            'Hello from the API',
        ];
        yield 'subscriptions' => [
            'subscriptions',
            static fn (CircleSo $sdk): mixed => $sdk->subscriptions()->all(5),
            [0, 'status'],
            'active',
        ];
        yield 'events' => [
            'events',
            static fn (CircleSo $sdk): mixed => $sdk->events()->all(5),
            [0, 'location_type'],
            'virtual',
        ];
        yield 'event attendees' => [
            'event_attendees',
            static fn (CircleSo $sdk): mixed => $sdk->eventAttendees()->all(71, 5),
            [0, 'member_email'],
            'member@example.com',
        ];
        yield 'charges' => [
            'charges',
            static fn (CircleSo $sdk): mixed => $sdk->charges()->all(5),
            [0, 'amount'],
            2500,
        ];
        yield 'likes' => [
            'likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->forPost(21),
            ['records', 0, 'email'],
            'member@example.com',
        ];
        yield 'community member spaces' => [
            'community_member_spaces',
            static fn (CircleSo $sdk): mixed => $sdk->communityMemberSpaces()->all('member@example.com'),
            ['records', 0, 'slug'],
            'general',
        ];
        yield 'profile fields' => [
            'profile_fields',
            static fn (CircleSo $sdk): mixed => $sdk->profileFields()->all(),
            [0, 'key'],
            'company',
        ];
        yield 'course sections' => [
            'course_sections',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->sections(12, 5),
            ['records', 0, 'name'],
            'Getting Started',
        ];
        yield 'course lessons' => [
            'course_lessons',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->lessons(12, 121, 5),
            ['records', 0, 'status'],
            'published',
        ];
        yield 'notification preferences' => [
            'notification_preferences',
            static fn (CircleSo $sdk): mixed => $sdk->notifications()->preferences(['token' => 'abc']),
            ['records', 0, 'notification_type'],
            'post_comment',
        ];
        yield 'topics' => [
            'topics',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->all(5),
            [0, 'admin_only'],
            true,
        ];
        yield 'contacts' => [
            'contact',
            static fn (CircleSo $sdk): mixed => $sdk->contacts()->create(['email' => 'lead@example.com']),
            ['email'],
            'lead@example.com',
        ];
        yield 'flagged contents' => [
            'flagged_contents',
            static fn (CircleSo $sdk): mixed => $sdk->flaggedContents()->all(5),
            ['records', 0, 'status'],
            'pending',
        ];
    }
}
