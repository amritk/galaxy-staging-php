<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Attributes\Required;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;
use DemoAPIScalarGalaxy\Planets\Satellite\Orbit;
use DemoAPIScalarGalaxy\Planets\Satellite\Type;

/**
 * Every satellite in the Scalar Galaxy.
 *
 * @phpstan-import-type OrbitShape from \DemoAPIScalarGalaxy\Planets\Satellite\Orbit
 *
 * @phpstan-type SatelliteShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   id?: int|null,
 *   description?: string|null,
 *   diameter?: float|null,
 *   orbit?: null|Orbit|OrbitShape,
 * }
 */
final class Satellite implements BaseModel
{
    /** @use SdkModel<SatelliteShape> */
    use SdkModel;

    #[Required]
    public string $name;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?int $id;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Diameter in kilometers.
     */
    #[Optional]
    public ?float $diameter;

    #[Optional]
    public ?Orbit $orbit;

    /**
     * `new Satellite()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Satellite::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Satellite)->withName(...)->withType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type> $type
     * @param Orbit|OrbitShape|null $orbit
     */
    public static function with(
        string $name,
        Type|string $type,
        ?int $id = null,
        ?string $description = null,
        ?float $diameter = null,
        Orbit|array|null $orbit = null,
    ): self {
        $self = new self();

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $id && ($self['id'] = $id);
        null !== $description && ($self['description'] = $description);
        null !== $diameter && ($self['diameter'] = $diameter);
        null !== $orbit && ($self['orbit'] = $orbit);

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withID(int $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Diameter in kilometers.
     */
    public function withDiameter(float $diameter): self
    {
        $self = clone $this;
        $self['diameter'] = $diameter;

        return $self;
    }

    /**
     * @param Orbit|OrbitShape $orbit
     */
    public function withOrbit(Orbit|array $orbit): self
    {
        $self = clone $this;
        $self['orbit'] = $orbit;

        return $self;
    }
}
