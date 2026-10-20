<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class V1EndpointCoverageTest extends TestCase
{
    public function test_request_encodes_scope_query_and_json_body(): void
    {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{}')]));
        $stack->push(Middleware::history($history));
        $sdk = $this->sdk(new Client(['handler' => $stack]));

        $sdk->posts()->create(12, ['name' => 'A post', 'is_pinned' => false], 34);

        $request = $history[0]['request'];
        parse_str($request->getUri()->getQuery(), $query);

        $this->assertSame('34', $query['community_id']);
        $this->assertSame('12', $query['space_id']);
        $this->assertSame(
            ['name' => 'A post', 'is_pinned' => false],
            json_decode((string) $request->getBody(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @dataProvider endpointProvider
     */
    public function test_v1_endpoint(
        string $method,
        string $path,
        Closure $call,
    ): void {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{}')]));
        $stack->push(Middleware::history($history));
        $sdk = $this->sdk(new Client(['handler' => $stack]));

        $call($sdk);

        $this->assertCount(1, $history);
        $request = $history[0]['request'];
        $this->assertSame($method, $request->getMethod());
        $this->assertSame($path, $request->getUri()->getPath());
    }

    /**
     * @return iterable<string, array{string, string, Closure(CircleSo): mixed}>
     */
    public static function endpointProvider(): iterable
    {
        yield 'spaces show' => [
            'GET', '/api/v1/spaces/2',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->show(2, 5),
        ];
        yield 'spaces create' => [
            'POST', '/api/v1/spaces',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->create(['name' => 'Space'], 5),
        ];
        yield 'spaces delete' => [
            'DELETE', '/api/v1/spaces/2',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->delete(2, 5),
        ];
        yield 'space members index' => [
            'GET', '/api/v1/space_members',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->members(2, 5),
        ];
        yield 'space group member show' => [
            'GET', '/api/v1/space_group_member',
            static fn (CircleSo $sdk): mixed => $sdk->spaceGroupMembers()->show('a@example.com', 2, 5),
        ];
        yield 'space group member add' => [
            'POST', '/api/v1/space_group_members',
            static fn (CircleSo $sdk): mixed => $sdk->spaceGroupMembers()->add('a@example.com', 2, 5),
        ];
        yield 'space group member remove' => [
            'DELETE', '/api/v1/space_group_members',
            static fn (CircleSo $sdk): mixed => $sdk->spaceGroupMembers()->remove('a@example.com', 2, 5),
        ];
        yield 'space member add' => [
            'POST', '/api/v1/space_members',
            static fn (CircleSo $sdk): mixed => $sdk->spaceMembers()->add('a@example.com', 2, 5),
        ];
        yield 'space member remove' => [
            'DELETE', '/api/v1/space_members',
            static fn (CircleSo $sdk): mixed => $sdk->spaceMembers()->remove('a@example.com', 2, 5),
        ];
        yield 'posts index' => [
            'GET', '/api/v1/posts',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->all(2, 5),
        ];
        yield 'posts show' => [
            'GET', '/api/v1/posts/3',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->show(3, 5),
        ];
        yield 'posts create' => [
            'POST', '/api/v1/posts',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->create(2, ['name' => 'Post'], 5),
        ];
        yield 'posts update' => [
            'PUT', '/api/v1/posts/3',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->update(3, ['name' => 'Post'], 5),
        ];
        yield 'posts delete' => [
            'DELETE', '/api/v1/posts/3',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->delete(3, 5),
        ];
        yield 'comments index' => [
            'GET', '/api/v1/comments',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->all(5, postId: 3),
        ];
        yield 'comments show' => [
            'GET', '/api/v1/comments/4',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->show(4, 5),
        ];
        yield 'comments create' => [
            'POST', '/api/v1/comments',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->create(2, 3, ['body' => 'Hi'], 5),
        ];
        yield 'comments delete' => [
            'DELETE', '/api/v1/comments/4',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->delete(4, 5),
        ];
        yield 'group message' => [
            'POST', '/api/v1/messages',
            static fn (CircleSo $sdk): mixed => $sdk->messages()->group(['a@example.com'], 'Hi', 5),
        ];
        yield 'direct message' => [
            'POST', '/api/v1/messages',
            static fn (CircleSo $sdk): mixed => $sdk->messages()->direct('a@example.com', 'Hi', 5),
        ];
        yield 'subscriptions index' => [
            'GET', '/api/v1/community_member_subscriptions',
            static fn (CircleSo $sdk): mixed => $sdk->subscriptions()->all(5),
        ];
        yield 'events index' => [
            'GET', '/api/v1/events',
            static fn (CircleSo $sdk): mixed => $sdk->events()->all(5),
        ];
        yield 'events create' => [
            'POST', '/api/v1/events',
            static fn (CircleSo $sdk): mixed => $sdk->events()->create(2, ['event' => []], 5),
        ];
        yield 'events update' => [
            'PUT', '/api/v1/events/3',
            static fn (CircleSo $sdk): mixed => $sdk->events()->update(3, 2, ['event' => []], 5),
        ];
        yield 'events delete' => [
            'DELETE', '/api/v1/events/3',
            static fn (CircleSo $sdk): mixed => $sdk->events()->delete(3, 2, 5),
        ];
        yield 'event attendees index' => [
            'GET', '/api/v1/event_attendees',
            static fn (CircleSo $sdk): mixed => $sdk->eventAttendees()->all(3, 5),
        ];
        yield 'event attendees create' => [
            'POST', '/api/v1/event_attendees',
            static fn (CircleSo $sdk): mixed => $sdk->eventAttendees()->rsvp(3, 'a@example.com', 5),
        ];
        yield 'event attendees delete' => [
            'DELETE', '/api/v1/event_attendees',
            static fn (CircleSo $sdk): mixed => $sdk->eventAttendees()->remove(3, 'a@example.com', 5),
        ];
        yield 'charges index' => [
            'GET', '/api/v1/community_member_charges',
            static fn (CircleSo $sdk): mixed => $sdk->charges()->all(5),
        ];
        yield 'post likes index' => [
            'GET', '/api/v1/posts/3/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->forPost(3),
        ];
        yield 'post likes create' => [
            'POST', '/api/v1/posts/3/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->likePost(3, 'a@example.com'),
        ];
        yield 'post likes delete' => [
            'DELETE', '/api/v1/posts/3/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->unlikePost(3, 'a@example.com'),
        ];
        yield 'comment likes index' => [
            'GET', '/api/v1/comments/4/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->forComment(4),
        ];
        yield 'comment likes create' => [
            'POST', '/api/v1/comments/4/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->likeComment(4, 'a@example.com'),
        ];
        yield 'comment likes delete' => [
            'DELETE', '/api/v1/comments/4/likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->unlikeComment(4, 'a@example.com'),
        ];
        yield 'community member spaces index' => [
            'GET', '/api/v1/community_member_spaces',
            static fn (CircleSo $sdk): mixed => $sdk->communityMemberSpaces()->all('a@example.com'),
        ];
        yield 'profile fields index' => [
            'GET', '/api/v1/page_profile_fields',
            static fn (CircleSo $sdk): mixed => $sdk->profileFields()->all(),
        ];
        yield 'course sections index' => [
            'GET', '/api/v1/course_sections',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->sections(2, 5),
        ];
        yield 'course sections show' => [
            'GET', '/api/v1/course_sections/3',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->showSection(3, 5),
        ];
        yield 'course sections create' => [
            'POST', '/api/v1/course_sections',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->createSection(['name' => 'Section'], 5),
        ];
        yield 'course sections update' => [
            'PATCH', '/api/v1/course_sections/3',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->updateSection(3, ['name' => 'Section'], 5),
        ];
        yield 'course sections delete' => [
            'DELETE', '/api/v1/course_sections/3',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->deleteSection(3, 5),
        ];
        yield 'course lessons index' => [
            'GET', '/api/v1/course_lessons',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->lessons(2, 3, 5),
        ];
        yield 'course lessons show' => [
            'GET', '/api/v1/course_lessons/4',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->showLesson(4, 5),
        ];
        yield 'course lessons create' => [
            'POST', '/api/v1/course_lessons',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->createLesson(['name' => 'Lesson'], 5),
        ];
        yield 'course lessons update' => [
            'PATCH', '/api/v1/course_lessons/4',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->updateLesson(4, ['name' => 'Lesson'], 5),
        ];
        yield 'course lessons delete' => [
            'DELETE', '/api/v1/course_lessons/4',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->deleteLesson(4, 5),
        ];
        yield 'course lesson progress update' => [
            'PATCH', '/api/v1/course_lesson_progress',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->updateLessonProgress(4, 'a@example.com', 5),
        ];
        yield 'notifications unsubscribe' => [
            'GET', '/public/unsubscribe',
            static fn (CircleSo $sdk): mixed => $sdk->notifications()->unsubscribe(['token' => 'abc']),
        ];
        yield 'notification preferences index' => [
            'GET', '/public/notification_preferences',
            static fn (CircleSo $sdk): mixed => $sdk->notifications()->preferences(['token' => 'abc']),
        ];
        yield 'notification preferences update' => [
            'PATCH', '/public/notification_preferences',
            static fn (CircleSo $sdk): mixed => $sdk->notifications()->updatePreferences([]),
        ];
        yield 'topics index' => [
            'GET', '/api/v1/topics',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->all(5),
        ];
        yield 'topics create' => [
            'POST', '/api/v1/topics',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->create(['name' => 'Topic'], 5),
        ];
        yield 'topics update' => [
            'PUT', '/api/v1/topics/3',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->update(3, ['name' => 'Topic'], 5),
        ];
        yield 'topics delete' => [
            'DELETE', '/api/v1/topics/3',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->delete(3, 5),
        ];
        yield 'contacts create' => [
            'POST', '/api/v1/contacts',
            static fn (CircleSo $sdk): mixed => $sdk->contacts()->create(['email' => 'a@example.com']),
        ];
        yield 'flagged contents index' => [
            'GET', '/api/v1/flagged_contents',
            static fn (CircleSo $sdk): mixed => $sdk->flaggedContents()->all(5),
        ];
        yield 'tagged members index' => [
            'GET', '/api/v1/tagged_members',
            static fn (CircleSo $sdk): mixed => $sdk->taggedMembers()->all(),
        ];
        yield 'tagged members show' => [
            'GET', '/api/v1/tagged_members/3',
            static fn (CircleSo $sdk): mixed => $sdk->taggedMembers()->show(3),
        ];
    }
}
