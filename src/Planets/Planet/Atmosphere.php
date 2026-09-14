<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets\Planet;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type AtmosphereShape = array{
 *   compound?: string|null, percentage?: float|null
 * }
 */
final class Atmosphere implements BaseModel
{
    /** @use SdkModel<AtmosphereShape> */
    use SdkModel;

    #[Optional]
    public ?string $compound;

    #[Optional]
    public ?float $percentage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $compound = null,
        ?float $percentage = null,
    ): self {
        $self = new self();

        null !== $compound && ($self['compound'] = $compound);
        null !== $percentage && ($self['percentage'] = $percentage);

        return $self;
    }

    public function withCompound(string $compound): self
    {
        $self = clone $this;
        $self['compound'] = $compound;

        return $self;
    }

    public function withPercentage(float $percentage): self
    {
        $self = clone $this;
        $self['percentage'] = $percentage;

        return $self;
    }
}
