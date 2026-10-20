<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Courses extends AbstractEndpoint implements EndpointInterface
{
    /** Get list of files in a lesson */
    /** @param array<string, mixed> $query */
    public function getListOfFilesInALesson(int|string $courseId, int|string $lessonId, array $query = []): mixed
    {
        return $this->request('GET', "/courses/{$courseId}/lessons/{$lessonId}/files", $query);
    }

    /** Update a lesson progress */
    /** @param array<string, mixed> $data */
    public function updateALessonProgress(int|string $courseId, int|string $lessonId, array $data): mixed
    {
        return $this->request('PATCH', "/courses/{$courseId}/lessons/{$lessonId}/progress", [], $data);
    }

    /** Get a lesson in a course */
    public function getALessonInACourse(int|string $courseId, int|string $id): mixed
    {
        return $this->request('GET', "/courses/{$courseId}/lessons/{$id}");
    }

    /** Get list of sections in a course */
    public function getListOfSectionsInACourse(int|string $courseId): mixed
    {
        return $this->request('GET', "/courses/{$courseId}/sections");
    }

    /** Get course topics */
    /** @param array<string, mixed> $query */
    public function getCourseTopics(array $query = []): mixed
    {
        return $this->request('GET', "/course_topics", $query);
    }
}
