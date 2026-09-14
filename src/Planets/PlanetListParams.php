<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Concerns\SdkParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * It's easy to say you know them all, but do you really? Retrieve all the planets and check whether you missed one.
 *
 * @see DemoAPIScalarGalaxy\Services\PlanetsService::list()
 *
 * @phpstan-type PlanetListParamsShape = array{limit?: int|null, offset?: int|null}
 */
final class PlanetListParams implements BaseModel
{
    /** @use SdkModel<PlanetListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The number of items to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * The number of items to skip before starting to collect the result set.
     */
    #[Optional]
    public ?int $offset;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $limit = null, ?int $offset = null): self
    {
        $self = new self();

        null !== $limit && ($self['limit'] = $limit);
        null !== $offset && ($self['offset'] = $offset);

        return $self;
    }

    /**
     * The number of items to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * The number of items to skip before starting to collect the result set.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
