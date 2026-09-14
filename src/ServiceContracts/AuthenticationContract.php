<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\Authentication\Token;
use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
interface AuthenticationContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createToken(
        string $email,
        string $password,
        RequestOptions|array|null $requestOptions = null,
    ): Token;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createUser(
        string $email,
        string $password,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): User;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listMe(RequestOptions|array|null $requestOptions = null): User;
}
