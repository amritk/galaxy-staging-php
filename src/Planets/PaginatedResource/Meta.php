<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets\PaginatedResource;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetaShape = array{
 *   limit?: int|null, next?: string|null, offset?: int|null, total?: int|null
 * }
 */
final class Meta implements BaseModel
{
    /** @use SdkModel<MetaShape> */
    use SdkModel;

    #[Optional]
    public ?int $limit;

    #[Optional(nullable: true)]
    public ?string $next;

    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?int $total;

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
        ?int $limit = null,
        ?string $next = null,
        ?int $offset = null,
        ?int $total = null,
    ): self {
        $self = new self();

        null !== $limit && ($self['limit'] = $limit);
        null !== $next && ($self['next'] = $next);
        null !== $offset && ($self['offset'] = $offset);
        null !== $total && ($self['total'] = $total);

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withNext(?string $next): self
    {
        $self = clone $this;
        $self['next'] = $next;

        return $self;
    }

    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
