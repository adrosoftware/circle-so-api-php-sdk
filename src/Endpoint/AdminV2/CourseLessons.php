<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CourseLessons extends AbstractEndpoint implements EndpointInterface
{
    /** Create a course lesson */
    /** @param array<string, mixed> $data */
    public function createACourseLesson(array $data): mixed
    {
        return $this->request('POST', "/course_lessons", [], $data);
    }

    /** List course lessons */
    /** @param array<string, mixed> $query */
    public function listCourseLessons(array $query = []): mixed
    {
        return $this->request('GET', "/course_lessons", $query);
    }

    /** Delete a course lesson */
    public function deleteACourseLesson(int|string $id): mixed
    {
        return $this->request('DELETE', "/course_lessons/{$id}");
    }

    /** Show a course lesson */
    public function showACourseLesson(int|string $id): mixed
    {
        return $this->request('GET', "/course_lessons/{$id}");
    }

    /** Update a course lesson */
    /** @param array<string, mixed> $data */
    public function updateACourseLesson(int|string $id, array $data): mixed
    {
        return $this->request('PATCH', "/course_lessons/{$id}", [], $data);
    }

    /** Reorder course lessons */
    /** @param array<string, mixed> $data */
    public function reorderCourseLessons(array $data): mixed
    {
        return $this->request('PUT', "/course_lessons/reorder", [], $data);
    }
}
