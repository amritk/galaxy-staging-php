<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets\Satellite;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type OrbitShape = array{
 *   distance?: float|null, orbitalPeriod?: float|null, planetID?: int|null
 * }
 */
final class Orbit implements BaseModel
{
    /** @use SdkModel<OrbitShape> */
    use SdkModel;

    /**
     * Average distance from the planet in kilometers.
     */
    #[Optional]
    public ?float $distance;

    /**
     * Orbital period in Earth days.
     */
    #[Optional]
    public ?float $orbitalPeriod;

    /**
     * The ID of the planet this satellite orbits.
     */
    #[Optional('planetId')]
    public ?int $planetID;

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
        ?float $distance = null,
        ?float $orbitalPeriod = null,
        ?int $planetID = null,
    ): self {
        $self = new self();

        null !== $distance && ($self['distance'] = $distance);
        null !== $orbitalPeriod && ($self['orbitalPeriod'] = $orbitalPeriod);
        null !== $planetID && ($self['planetID'] = $planetID);

        return $self;
    }

    /**
     * Average distance from the planet in kilometers.
     */
    public function withDistance(float $distance): self
    {
        $self = clone $this;
        $self['distance'] = $distance;

        return $self;
    }

    /**
     * Orbital period in Earth days.
     */
    public function withOrbitalPeriod(float $orbitalPeriod): self
    {
        $self = clone $this;
        $self['orbitalPeriod'] = $orbitalPeriod;

        return $self;
    }

    /**
     * The ID of the planet this satellite orbits.
     */
    public function withPlanetID(int $planetID): self
    {
        $self = clone $this;
        $self['planetID'] = $planetID;

        return $self;
    }
}
