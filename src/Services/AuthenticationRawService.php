<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\AuthenticationCreateTokenParams;
use DemoAPIScalarGalaxy\Authentication\AuthenticationCreateUserParams;
use DemoAPIScalarGalaxy\Authentication\Token;
use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\AuthenticationRawContract;

/**
 * Some endpoints are public, but some require authentication. We provide all the required endpoints to create an account and authorize yourself.
 *
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
final class AuthenticationRawService implements AuthenticationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @api
     *
     * Yeah, this is the boring security stuff. Just get your super secret token and move on.
     *
     * @param array{
     *   email: string, password: string
     * }|AuthenticationCreateTokenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Token>
     *
     * @throws APIException
     */
    public function createToken(
        array|AuthenticationCreateTokenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthenticationCreateTokenParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'auth/token',
            body: (object) $parsed,
            options: $options,
            convert: Token::class,
        );
    }

    /**
     * @api
     *
     * Time to create a user account, eh?
     *
     * @param array{
     *   email: string, password: string, name?: string
     * }|AuthenticationCreateUserParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<User>
     *
     * @throws APIException
     */
    public function createUser(
        array|AuthenticationCreateUserParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AuthenticationCreateUserParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'user/signup',
            body: (object) $parsed,
            options: $options,
            convert: User::class,
        );
    }

    /**
     * @api
     *
     * Find yourself they say. That's what you can do here.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<User>
     *
     * @throws APIException
     */
    public function listMe(RequestOptions|array|null $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'me',
            options: $requestOptions,
            convert: User::class,
        );
    }
}
