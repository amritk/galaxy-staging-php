<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Webhooks;

use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewPlanetWebhookEventShape = array<string,mixed>
 */
final class NewPlanetWebhookEvent implements BaseModel
{
    /** @use SdkModel<NewPlanetWebhookEventShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        $self = new self();

        return $self;
    }
}
