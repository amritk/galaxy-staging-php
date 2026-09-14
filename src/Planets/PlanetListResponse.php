<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;
use DemoAPIScalarGalaxy\Planets\PaginatedResource\Meta;

/**
 * @phpstan-import-type MetaShape from \DemoAPIScalarGalaxy\Planets\PaginatedResource\Meta
 * @phpstan-import-type PlanetShape from \DemoAPIScalarGalaxy\Planets\Planet
 *
 * @phpstan-type PlanetListResponseShape = array{
 *   meta?: null|Meta|MetaShape, data?: list<Planet|PlanetShape>|null
 * }
 */
final class PlanetListResponse implements BaseModel
{
    /** @use SdkModel<PlanetListResponseShape> */
    use SdkModel;

    #[Optional]
    public ?Meta $meta;

    /** @var list<Planet>|null $data */
    #[Optional(list: Planet::class)]
    public ?array $data;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Meta|MetaShape|null $meta
     * @param list<Planet|PlanetShape>|null $data
     */
    public static function with(
        Meta|array|null $meta = null,
        ?array $data = null,
    ): self {
        $self = new self();

        null !== $meta && ($self['meta'] = $meta);
        null !== $data && ($self['data'] = $data);

        return $self;
    }

    /**
     * @param Meta|MetaShape $meta
     */
    public function withMeta(Meta|array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }

    /**
     * @param list<Planet|PlanetShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
