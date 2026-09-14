<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;
use DemoAPIScalarGalaxy\Planets\PaginatedResource\Meta;

/**
 * A paginated resource.
 *
 * @phpstan-import-type MetaShape from \DemoAPIScalarGalaxy\Planets\PaginatedResource\Meta
 *
 * @phpstan-type PaginatedResourceShape = array{meta?: null|Meta|MetaShape}
 */
final class PaginatedResource implements BaseModel
{
    /** @use SdkModel<PaginatedResourceShape> */
    use SdkModel;

    #[Optional]
    public ?Meta $meta;

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
     */
    public static function with(Meta|array|null $meta = null): self
    {
        $self = new self();

        null !== $meta && ($self['meta'] = $meta);

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
}
