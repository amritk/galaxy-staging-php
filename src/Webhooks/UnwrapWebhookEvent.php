<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Webhooks;

use DemoAPIScalarGalaxy\Core\Concerns\SdkUnion;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\Converter;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type NewPlanetWebhookEventShape from \DemoAPIScalarGalaxy\Webhooks\NewPlanetWebhookEvent
 *
 * @phpstan-type UnwrapWebhookEventVariants = NewPlanetWebhookEvent
 * @phpstan-type UnwrapWebhookEventShape = UnwrapWebhookEventVariants|NewPlanetWebhookEventShape
 */
final class UnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [NewPlanetWebhookEvent::class];
    }
}
