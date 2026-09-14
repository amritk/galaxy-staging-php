<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Attributes\Required;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Concerns\SdkParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Type;

/**
 * Time to play god and create a new planet. What do you think? Ah, don't think too much. What could go wrong anyway?
 *
 * @see DemoAPIScalarGalaxy\Services\PlanetsService::create()
 *
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere
 * @phpstan-import-type UserShape from \DemoAPIScalarGalaxy\Authentication\User
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties
 * @phpstan-import-type SatelliteShape from \DemoAPIScalarGalaxy\Planets\Satellite
 *
 * @phpstan-type PlanetCreateParamsShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   atmosphere?: list<Atmosphere|AtmosphereShape>|null,
 *   creator?: null|User|UserShape,
 *   description?: string|null,
 *   discoveredAt?: \DateTimeInterface|null,
 *   failureCallbackURL?: string|null,
 *   habitabilityIndex?: float|null,
 *   image?: string|null,
 *   physicalProperties?: null|PhysicalProperties|PhysicalPropertiesShape,
 *   satellites?: list<Satellite|SatelliteShape>|null,
 *   successCallbackURL?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class PlanetCreateParams implements BaseModel
{
    /** @use SdkModel<PlanetCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $name;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Atmospheric composition.
     *
     * @var list<Atmosphere>|null $atmosphere
     */
    #[Optional(list: Atmosphere::class)]
    public ?array $atmosphere;

    /**
     * A user.
     */
    #[Optional]
    public ?User $creator;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional]
    public ?\DateTimeInterface $discoveredAt;

    /**
     * URL which gets invoked upon a failed operation.
     */
    #[Optional('failureCallbackUrl')]
    public ?string $failureCallbackURL;

    /**
     * A score from 0 to 1 indicating potential habitability.
     */
    #[Optional]
    public ?float $habitabilityIndex;

    #[Optional(nullable: true)]
    public ?string $image;

    #[Optional]
    public ?PhysicalProperties $physicalProperties;

    /** @var list<Satellite>|null $satellites */
    #[Optional(list: Satellite::class)]
    public ?array $satellites;

    /**
     * URL which gets invoked upon a successful operation.
     */
    #[Optional('successCallbackUrl')]
    public ?string $successCallbackURL;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new PlanetCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlanetCreateParams::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlanetCreateParams)->withName(...)->withType(...)
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
     * @param list<Atmosphere|AtmosphereShape>|null $atmosphere
     * @param User|UserShape|null $creator
     * @param PhysicalProperties|PhysicalPropertiesShape|null $physicalProperties
     * @param list<Satellite|SatelliteShape>|null $satellites
     * @param list<string>|null $tags
     */
    public static function with(
        string $name,
        Type|string $type,
        ?array $atmosphere = null,
        User|array|null $creator = null,
        ?string $description = null,
        ?\DateTimeInterface $discoveredAt = null,
        ?string $failureCallbackURL = null,
        ?float $habitabilityIndex = null,
        ?string $image = null,
        PhysicalProperties|array|null $physicalProperties = null,
        ?array $satellites = null,
        ?string $successCallbackURL = null,
        ?array $tags = null,
    ): self {
        $self = new self();

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $atmosphere && ($self['atmosphere'] = $atmosphere);
        null !== $creator && ($self['creator'] = $creator);
        null !== $description && ($self['description'] = $description);
        null !== $discoveredAt && ($self['discoveredAt'] = $discoveredAt);
        null !== $failureCallbackURL && ($self['failureCallbackURL'] =
            $failureCallbackURL);
        null !== $habitabilityIndex && ($self['habitabilityIndex'] =
            $habitabilityIndex);
        null !== $image && ($self['image'] = $image);
        null !== $physicalProperties && ($self['physicalProperties'] =
            $physicalProperties);
        null !== $satellites && ($self['satellites'] = $satellites);
        null !== $successCallbackURL && ($self['successCallbackURL'] =
            $successCallbackURL);
        null !== $tags && ($self['tags'] = $tags);

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

    /**
     * Atmospheric composition.
     *
     * @param list<Atmosphere|AtmosphereShape> $atmosphere
     */
    public function withAtmosphere(array $atmosphere): self
    {
        $self = clone $this;
        $self['atmosphere'] = $atmosphere;

        return $self;
    }

    /**
     * A user.
     *
     * @param User|UserShape $creator
     */
    public function withCreator(User|array $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDiscoveredAt(\DateTimeInterface $discoveredAt): self
    {
        $self = clone $this;
        $self['discoveredAt'] = $discoveredAt;

        return $self;
    }

    /**
     * URL which gets invoked upon a failed operation.
     */
    public function withFailureCallbackURL(string $failureCallbackURL): self
    {
        $self = clone $this;
        $self['failureCallbackURL'] = $failureCallbackURL;

        return $self;
    }

    /**
     * A score from 0 to 1 indicating potential habitability.
     */
    public function withHabitabilityIndex(float $habitabilityIndex): self
    {
        $self = clone $this;
        $self['habitabilityIndex'] = $habitabilityIndex;

        return $self;
    }

    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * @param PhysicalProperties|PhysicalPropertiesShape $physicalProperties
     */
    public function withPhysicalProperties(PhysicalProperties|array $physicalProperties): self
    {
        $self = clone $this;
        $self['physicalProperties'] = $physicalProperties;

        return $self;
    }

    /**
     * @param list<Satellite|SatelliteShape> $satellites
     */
    public function withSatellites(array $satellites): self
    {
        $self = clone $this;
        $self['satellites'] = $satellites;

        return $self;
    }

    /**
     * URL which gets invoked upon a successful operation.
     */
    public function withSuccessCallbackURL(string $successCallbackURL): self
    {
        $self = clone $this;
        $self['successCallbackURL'] = $successCallbackURL;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
