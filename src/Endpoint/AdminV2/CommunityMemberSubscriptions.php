<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMemberSubscriptions extends AbstractEndpoint implements EndpointInterface
{
    /** Cancel Community Member Subscription */
    /** @param array<string, mixed> $data */
    public function cancelCommunityMemberSubscription(int|string $id, array $data = []): mixed
    {
        return $this->request('POST', "/community_member_subscriptions/{$id}/cancel", [], $data);
    }

    /** Export Community Member Subscriptions */
    /** @param array<string, mixed> $query */
    public function exportCommunityMemberSubscriptions(array $query = []): mixed
    {
        return $this->request('POST', "/community_member_subscriptions/export", $query);
    }

    /** Change a billing date or extend a genuine trial; change_billing_date requires billing_date and extend_trial requires days_to_extend (the opposite field is ignored); ineligible selected operations return 401 before input validation */
    /** @param array<string, mixed> $data */
    public function changeBillingDateOrExtendTrialCommunityMemberSubscription(int|string $id, array $data = []): mixed
    {
        return $this->request('PATCH', "/community_member_subscriptions/{$id}/billing_date", [], $data);
    }

    /** Community Member Subscriptions List */
    /** @param array<string, mixed> $query */
    public function communityMemberSubscriptionsList(array $query = []): mixed
    {
        return $this->request('GET', "/community_member_subscriptions", $query);
    }

    /** Resume Community Member Subscription */
    public function resumeCommunityMemberSubscription(int|string $id): mixed
    {
        return $this->request('POST', "/community_member_subscriptions/{$id}/resume");
    }
}
