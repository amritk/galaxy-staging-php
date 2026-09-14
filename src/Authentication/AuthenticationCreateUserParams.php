<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Authentication;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Attributes\Required;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Concerns\SdkParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * Time to create a user account, eh?
 *
 * @see DemoAPIScalarGalaxy\Services\AuthenticationService::createUser()
 *
 * @phpstan-type AuthenticationCreateUserParamsShape = array{
 *   email: string, password: string, name?: string|null
 * }
 */
final class AuthenticationCreateUserParams implements BaseModel
{
    /** @use SdkModel<AuthenticationCreateUserParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $email;

    #[Required]
    public string $password;

    #[Optional]
    public ?string $name;

    /**
     * `new AuthenticationCreateUserParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthenticationCreateUserParams::with(email: ..., password: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthenticationCreateUserParams)->withEmail(...)->withPassword(...)
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
     */
    public static function with(
        string $email,
        string $password,
        ?string $name = null,
    ): self {
        $self = new self();

        $self['email'] = $email;
        $self['password'] = $password;

        null !== $name && ($self['name'] = $name);

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withPassword(string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
