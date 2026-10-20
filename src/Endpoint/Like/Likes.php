<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Like;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Likes extends AbstractEndpoint implements EndpointInterface
{
    public function forPost(int $postId): mixed
    {
        return $this->request('GET', "/posts/{$postId}/likes");
    }

    public function likePost(int $postId, ?string $userEmail = null): mixed
    {
        return $this->request('POST', "/posts/{$postId}/likes", ['user_email' => $userEmail]);
    }

    public function unlikePost(int $postId, ?string $userEmail = null): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/likes", ['user_email' => $userEmail]);
    }

    public function forComment(int $commentId): mixed
    {
        return $this->request('GET', "/comments/{$commentId}/likes");
    }

    public function likeComment(int $commentId, ?string $userEmail = null): mixed
    {
        return $this->request('POST', "/comments/{$commentId}/likes", ['user_email' => $userEmail]);
    }

    public function unlikeComment(int $commentId, ?string $userEmail = null): mixed
    {
        return $this->request('DELETE', "/comments/{$commentId}/likes", ['user_email' => $userEmail]);
    }
}
