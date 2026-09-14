<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Conversion;
use DemoAPIScalarGalaxy\Core\Exceptions\WebhookException;
use DemoAPIScalarGalaxy\Core\Util;
use DemoAPIScalarGalaxy\ServiceContracts\WebhooksContract;
use DemoAPIScalarGalaxy\Webhooks\NewPlanetWebhookEvent;
use DemoAPIScalarGalaxy\Webhooks\UnwrapWebhookEvent;
use StandardWebhooks\Exception\WebhookVerificationException;
use StandardWebhooks\Webhook;

final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(
        private Client $client,
    ) {
        $this->raw = new WebhooksRawService($client);
    }

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
    ): NewPlanetWebhookEvent {
        if (!is_null($headers)) {
            $secret = $secret ?? ($this->client->webhookSecret ?: null);
            if (is_null($secret)) {
                throw new WebhookException(
                    'Webhook key must not be null in order to unwrap',
                );
            }

            try {
                $flatHeaders = array_map(
                    fn(string|array $v): string => is_array($v)
                        ? $v[0] ?? ''
                        : $v,
                    $headers,
                );
                $webhook = new Webhook($secret);
                $webhook->verify($body, $flatHeaders);
            } catch (WebhookVerificationException $e) {
                throw new WebhookException(
                    'Could not verify webhook event signature',
                    previous: $e,
                );
            }
        }

        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(
                UnwrapWebhookEvent::class,
                value: $decoded,
            );
        } catch (\Throwable $e) {
            throw new WebhookException(
                'Error parsing webhook body',
                previous: $e,
            );
        }
    }
}
