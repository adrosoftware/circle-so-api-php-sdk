<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Course;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

class Courses extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @throws CommunityIdNotPresentException
     */
    public function sections(
        int $spaceId,
        ?int $communityId = null,
        ?int $page = null,
        ?int $perPage = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        $query = [
            'community_id' => $this->communityId,
            'space_id' => $spaceId,
        ];

        if ($page) {
            $query['page'] = $page;
        }

        if ($perPage) {
            $query['per_page'] = $perPage;
        }

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                '/course_sections?' . http_build_query($query)
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function showSection(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_sections/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function lessons(
        int $spaceId,
        int $sectionId,
        ?int $communityId = null,
        ?int $page = null,
        ?int $perPage = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        $query = [
            'community_id' => $this->communityId,
            'space_id' => $spaceId,
            'section_id' => $sectionId,
        ];

        if ($page) {
            $query['page'] = $page;
        }

        if ($perPage) {
            $query['per_page'] = $perPage;
        }

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                '/course_lessons?' . http_build_query($query)
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function showLesson(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/course_lessons/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * Create a course lesson.
     *
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function createLesson(
        array $data,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                uri: "/course_lessons?community_id={$this->communityId}",
                body: json_encode($data),
            )
        );
    }

    /**
     * Delete a course lesson.
     *
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function deleteLesson(
        int $id,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/course_lessons/{$id}?community_id={$this->communityId}",
            )
        );
    }
}
