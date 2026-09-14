<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\Authentication\AuthenticationCreateTokenParams;
use DemoAPIScalarGalaxy\Authentication\AuthenticationCreateUserParams;
use DemoAPIScalarGalaxy\Authentication\Token;
use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
interface AuthenticationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AuthenticationCreateTokenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Token>
     *
     * @throws APIException
     */
    public function createToken(
        array|AuthenticationCreateTokenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AuthenticationCreateUserParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<User>
     *
     * @throws APIException
     */
    public function createUser(
        array|AuthenticationCreateUserParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<User>
     *
     * @throws APIException
     */
    public function listMe(RequestOptions|array|null $requestOptions = null): BaseResponse;
}
