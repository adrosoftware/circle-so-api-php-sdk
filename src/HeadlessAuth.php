<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Endpoint\RawEndpoint;

final class HeadlessAuth extends AbstractClient
{
    public function __construct(string $token, ?Options $options = null)
    {
        parent::__construct($token, ($options ?? new Options())->withApiVersion('v1/headless'));
    }

    public static function make(string $token, ?Options $options = null): self
    {
        return new self($token, $options);
    }

    protected function authorizationHeader(): string
    {
        return "Bearer {$this->token}";
    }
    public function tokens(): Endpoint\HeadlessAuth\Headless
    {
        return new Endpoint\HeadlessAuth\Headless($this);
    }

    public function raw(): RawEndpoint
    {
        return new RawEndpoint($this);
    }
}
