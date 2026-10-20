<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Workflows extends AbstractEndpoint implements EndpointInterface
{
    /** Activate an automation (dynamic) workflow so it starts running automatically */
    public function activateAnAutomationDynamicWorkflowSoItStartsRunningAutomatically(int|string $id): mixed
    {
        return $this->request('PUT', "/workflows/{$id}/activate");
    }

    /** Deactivate an automation (dynamic) workflow so it stops running automatically */
    public function deactivateAnAutomationDynamicWorkflowSoItStopsRunningAutomatically(int|string $id): mixed
    {
        return $this->request('PUT', "/workflows/{$id}/deactivate");
    }

    /** Duplicate a workflow */
    public function duplicateAWorkflow(int|string $id): mixed
    {
        return $this->request('POST', "/workflows/{$id}/duplicate");
    }

    /** List a community's automations/workflows */
    /** @param array<string, mixed> $query */
    public function listACommunitysAutomationsWorkflows(array $query = []): mixed
    {
        return $this->request('GET', "/workflows", $query);
    }

    /** Get Workflow */
    public function getWorkflow(int|string $id): mixed
    {
        return $this->request('GET', "/workflows/{$id}");
    }
}
