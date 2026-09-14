<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams;

use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\PhysicalProperties\Temperature;
use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TemperatureShape from \DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\PhysicalProperties\Temperature
 *
 * @phpstan-type PhysicalPropertiesShape = array{
 *   gravity?: float|null,
 *   mass?: float|null,
 *   radius?: float|null,
 *   temperature?: null|Temperature|TemperatureShape,
 * }
 */
final class PhysicalProperties implements BaseModel
{
    /** @use SdkModel<PhysicalPropertiesShape> */
    use SdkModel;

    /**
     * Surface gravity in Earth g.
     */
    #[Optional]
    public ?float $gravity;

    /**
     * Mass in Earth masses (must be greater than 0).
     */
    #[Optional]
    public ?float $mass;

    /**
     * Radius in Earth radii (must be greater than 0).
     */
    #[Optional]
    public ?float $radius;

    #[Optional]
    public ?Temperature $temperature;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Temperature|TemperatureShape|null $temperature
     */
    public static function with(
        ?float $gravity = null,
        ?float $mass = null,
        ?float $radius = null,
        Temperature|array|null $temperature = null,
    ): self {
        $self = new self();

        null !== $gravity && ($self['gravity'] = $gravity);
        null !== $mass && ($self['mass'] = $mass);
        null !== $radius && ($self['radius'] = $radius);
        null !== $temperature && ($self['temperature'] = $temperature);

        return $self;
    }

    /**
     * Surface gravity in Earth g.
     */
    public function withGravity(float $gravity): self
    {
        $self = clone $this;
        $self['gravity'] = $gravity;

        return $self;
    }

    /**
     * Mass in Earth masses (must be greater than 0).
     */
    public function withMass(float $mass): self
    {
        $self = clone $this;
        $self['mass'] = $mass;

        return $self;
    }

    /**
     * Radius in Earth radii (must be greater than 0).
     */
    public function withRadius(float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * @param Temperature|TemperatureShape $temperature
     */
    public function withTemperature(Temperature|array $temperature): self
    {
        $self = clone $this;
        $self['temperature'] = $temperature;

        return $self;
    }
}
