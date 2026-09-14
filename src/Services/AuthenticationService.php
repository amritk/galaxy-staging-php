<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\Token;
use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Core\Util;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\AuthenticationContract;

/**
 * Some endpoints are public, but some require authentication. We provide all the required endpoints to create an account and authorize yourself.
 *
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
final class AuthenticationService implements AuthenticationContract
{
    /**
     * @api
     */
    public AuthenticationRawService $raw;

    /**
     * @internal
     */
    public function __construct(
        private Client $client,
    ) {
        $this->raw = new AuthenticationRawService($client);
    }

    /**
     * @api
     *
     * Yeah, this is the boring security stuff. Just get your super secret token and move on.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createToken(
        string $email,
        string $password,
        RequestOptions|array|null $requestOptions = null,
    ): Token {
        $params = Util::removeNulls([
            'email' => $email,
            'password' => $password,
        ]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createToken(
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Time to create a user account, eh?
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
    ): User {
        $params = Util::removeNulls([
            'email' => $email,
            'password' => $password,
            'name' => $name,
        ]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createUser(
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Find yourself they say. That's what you can do here.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listMe(RequestOptions|array|null $requestOptions = null): User
    {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listMe(requestOptions: $requestOptions);

        return $response->parse();
    }
}
