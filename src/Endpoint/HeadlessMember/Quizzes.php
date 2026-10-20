<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Quizzes extends AbstractEndpoint implements EndpointInterface
{
    /** Get latest quiz attempts for a course (for admins) */
    /** @param array<string, mixed> $query */
    public function getLatestQuizAttemptsForACourseForAdmins(int|string $courseId, array $query = []): mixed
    {
        return $this->request('GET', "/courses/{$courseId}/quiz_attempts", $query);
    }

    /** Create a quiz attempt */
    /** @param array<string, mixed> $data */
    public function createAQuizAttempt(int|string $quizId, array $data = []): mixed
    {
        return $this->request('POST', "/quizzes/{$quizId}/attempts", [], $data);
    }

    /** Get a quiz attempt */
    /** @param array<string, mixed> $query */
    public function getAQuizAttempt(int|string $quizId, int|string $id, array $query = []): mixed
    {
        return $this->request('GET', "/quizzes/{$quizId}/attempts/{$id}", $query);
    }

    /** Update a quiz attempt result when passing grade is not set */
    /** @param array<string, mixed> $data */
    public function updateAttemptResult(int|string $quizId, int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/quizzes/{$quizId}/attempts/{$id}", [], $data);
    }
}
