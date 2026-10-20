<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CourseLessonProgress extends AbstractEndpoint implements EndpointInterface
{
    /** Update Course Lesson Progress */
    /** @param array<string, mixed> $data */
    public function updateCourseLessonProgress(array $data): mixed
    {
        return $this->request('PUT', "/course_lesson_progress", [], $data);
    }
}
