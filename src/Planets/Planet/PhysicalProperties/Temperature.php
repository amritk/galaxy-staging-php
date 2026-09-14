<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets\Planet\PhysicalProperties;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type TemperatureShape = array{
 *   average?: float|null, max?: float|null, min?: float|null
 * }
 */
final class Temperature implements BaseModel
{
    /** @use SdkModel<TemperatureShape> */
    use SdkModel;

    /**
     * Average temperature in Kelvin.
     */
    #[Optional]
    public ?float $average;

    /**
     * Maximum temperature in Kelvin.
     */
    #[Optional]
    public ?float $max;

    /**
     * Minimum temperature in Kelvin.
     */
    #[Optional]
    public ?float $min;

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
        ?float $average = null,
        ?float $max = null,
        ?float $min = null,
    ): self {
        $self = new self();

        null !== $average && ($self['average'] = $average);
        null !== $max && ($self['max'] = $max);
        null !== $min && ($self['min'] = $min);

        return $self;
    }

    /**
     * Average temperature in Kelvin.
     */
    public function withAverage(float $average): self
    {
        $self = clone $this;
        $self['average'] = $average;

        return $self;
    }

    /**
     * Maximum temperature in Kelvin.
     */
    public function withMax(float $max): self
    {
        $self = clone $this;
        $self['max'] = $max;

        return $self;
    }

    /**
     * Minimum temperature in Kelvin.
     */
    public function withMin(float $min): self
    {
        $self = clone $this;
        $self['min'] = $min;

        return $self;
    }
}
