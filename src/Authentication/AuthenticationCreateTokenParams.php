<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Authentication;

use DemoAPIScalarGalaxy\Core\Attributes\Required;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Concerns\SdkParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * Yeah, this is the boring security stuff. Just get your super secret token and move on.
 *
 * @see DemoAPIScalarGalaxy\Services\AuthenticationService::createToken()
 *
 * @phpstan-type AuthenticationCreateTokenParamsShape = array{
 *   email: string, password: string
 * }
 */
final class AuthenticationCreateTokenParams implements BaseModel
{
    /** @use SdkModel<AuthenticationCreateTokenParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $email;

    #[Required]
    public string $password;

    /**
     * `new AuthenticationCreateTokenParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthenticationCreateTokenParams::with(email: ..., password: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthenticationCreateTokenParams)->withEmail(...)->withPassword(...)
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
    public static function with(string $email, string $password): self
    {
        $self = new self();

        $self['email'] = $email;
        $self['password'] = $password;

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
}
