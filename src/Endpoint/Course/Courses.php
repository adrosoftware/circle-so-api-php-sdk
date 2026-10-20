<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Course;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Courses extends AbstractEndpoint implements EndpointInterface
{
    public function sections(
        ?int $spaceId = null,
        ?int $communityId = null,
        ?int $page = null,
        ?int $perPage = null,
    ): mixed {
        return $this->request('GET', '/course_sections', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    public function showSection(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/course_sections/{$id}", $this->communityQuery($communityId));
    }

    /** @param array<string, mixed> $data */
    public function createSection(array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/course_sections', $this->communityQuery($communityId), $data);
    }

    /** @param array<string, mixed> $data */
    public function updateSection(int $id, array $data, ?int $communityId = null): mixed
    {
        return $this->request('PATCH', "/course_sections/{$id}", $this->communityQuery($communityId), $data);
    }

    public function deleteSection(int $id, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/course_sections/{$id}", $this->communityQuery($communityId));
    }

    public function lessons(
        ?int $spaceId = null,
        ?int $sectionId = null,
        ?int $communityId = null,
        ?int $page = null,
        ?int $perPage = null,
    ): mixed {
        return $this->request('GET', '/course_lessons', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
            'section_id' => $sectionId,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    public function showLesson(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/course_lessons/{$id}", $this->communityQuery($communityId));
    }

    /** @param array<string, mixed> $data */
    public function createLesson(array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/course_lessons', $this->communityQuery($communityId), $data);
    }

    /** @param array<string, mixed> $data */
    public function updateLesson(int $id, array $data, ?int $communityId = null): mixed
    {
        return $this->request('PATCH', "/course_lessons/{$id}", $this->communityQuery($communityId), $data);
    }

    public function deleteLesson(int $id, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/course_lessons/{$id}", $this->communityQuery($communityId));
    }

    public function updateLessonProgress(
        int $lessonId,
        string $memberEmail,
        ?int $communityId = null,
    ): mixed {
        return $this->request('PATCH', '/course_lesson_progress', [
            ...$this->communityQuery($communityId),
            'lesson_id' => $lessonId,
            'member_email' => $memberEmail,
        ]);
    }
}
