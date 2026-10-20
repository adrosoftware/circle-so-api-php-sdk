<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint;

use AdroSoftware\CircleSoSdk\{AdminV2, ClientBuilder, Options};
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class AdminV2AliasTest extends TestCase
{
    /** @dataProvider aliasProvider */
    public function test_v1_style_convenience_aliases(string $method, string $path, Closure $call): void
    {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([new Response(200, [], '{}')]));
        $stack->push(Middleware::history($history));
        $admin = AdminV2::make('secret', new Options([
            'client_builder' => new ClientBuilder(new Client(['handler' => $stack])),
        ]));

        $call($admin);

        self::assertSame($method, $history[0]['request']->getMethod());
        self::assertSame($path, $history[0]['request']->getUri()->getPath());
    }

    /** @return iterable<string, array{string, string, Closure(AdminV2): mixed}> */
    public static function aliasProvider(): iterable
    {
        yield 'community show' => ['GET', '/api/admin/v2/community', fn (AdminV2 $api) => $api->communities()->show()];
        yield 'community update' => [
            'PUT',
            '/api/admin/v2/community',
            fn (AdminV2 $api) => $api->communities()->update(['name' => 'Circle']),
        ];
        yield 'members index' => [
            'GET',
            '/api/admin/v2/community_members',
            fn (AdminV2 $api) => $api->communityMembers()->all(),
        ];
        yield 'members show' => [
            'GET',
            '/api/admin/v2/community_members/1',
            fn (AdminV2 $api) => $api->communityMembers()->show(1),
        ];
        yield 'members create' => [
            'POST',
            '/api/admin/v2/community_members',
            fn (AdminV2 $api) => $api->communityMembers()->create(['email' => 'member@example.com']),
        ];
        yield 'members update' => [
            'PUT',
            '/api/admin/v2/community_members/1',
            fn (AdminV2 $api) => $api->communityMembers()->update(1, ['name' => 'Member']),
        ];
        yield 'spaces index' => ['GET', '/api/admin/v2/spaces', fn (AdminV2 $api) => $api->spaces()->all()];
        yield 'spaces show' => ['GET', '/api/admin/v2/spaces/1', fn (AdminV2 $api) => $api->spaces()->show(1)];
        yield 'spaces create' => [
            'POST',
            '/api/admin/v2/spaces',
            fn (AdminV2 $api) => $api->spaces()->create(['name' => 'Space']),
        ];
        yield 'posts index' => ['GET', '/api/admin/v2/posts', fn (AdminV2 $api) => $api->posts()->all()];
        yield 'posts show' => ['GET', '/api/admin/v2/posts/1', fn (AdminV2 $api) => $api->posts()->show(1)];
        yield 'posts create' => [
            'POST',
            '/api/admin/v2/posts',
            fn (AdminV2 $api) => $api->posts()->create(['name' => 'Post']),
        ];
        yield 'comments index' => ['GET', '/api/admin/v2/comments', fn (AdminV2 $api) => $api->comments()->all()];
        yield 'comments show' => [
            'GET',
            '/api/admin/v2/comments/1',
            fn (AdminV2 $api) => $api->comments()->show(1),
        ];
        yield 'comments create' => [
            'POST',
            '/api/admin/v2/comments',
            fn (AdminV2 $api) => $api->comments()->create(['body' => 'Hello']),
        ];
    }
}
