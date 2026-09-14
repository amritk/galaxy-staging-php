<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Authentication;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * A token to authenticate a user.
 *
 * @phpstan-type TokenShape = array{token?: string|null}
 */
final class Token implements BaseModel
{
    /** @use SdkModel<TokenShape> */
    use SdkModel;

    #[Optional]
    public ?string $token;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $token = null): self
    {
        $self = new self();

        null !== $token && ($self['token'] = $token);

        return $self;
    }

    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }
}
