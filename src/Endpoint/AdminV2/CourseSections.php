<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CourseSections extends AbstractEndpoint implements EndpointInterface
{
    /** Create a course section */
    /** @param array<string, mixed> $data */
    public function createACourseSection(array $data): mixed
    {
        return $this->request('POST', "/course_sections", [], $data);
    }

    /** List Course Sections */
    /** @param array<string, mixed> $query */
    public function listCourseSections(array $query = []): mixed
    {
        return $this->request('GET', "/course_sections", $query);
    }

    /** Delete a course section */
    public function deleteACourseSection(int|string $id): mixed
    {
        return $this->request('DELETE', "/course_sections/{$id}");
    }

    /** Show a course section */
    public function showACourseSection(int|string $id): mixed
    {
        return $this->request('GET', "/course_sections/{$id}");
    }

    /** Update a course section */
    /** @param array<string, mixed> $data */
    public function updateACourseSection(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/course_sections/{$id}", [], $data);
    }
}
