<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\Core\Exceptions\WebhookException;
use DemoAPIScalarGalaxy\Webhooks\NewPlanetWebhookEvent;

interface WebhooksContract
{
    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * Passing `$headers` verifies the Standard Webhooks signature first; omitting them skips the check.
     *
     * @param array<string,string|list<string>>|null $headers
     *
     * @throws WebhookException
     */
    public function unwrap(
        string $body,
        ?array $headers = null,
        ?string $secret = null,
    ): NewPlanetWebhookEvent;
}
