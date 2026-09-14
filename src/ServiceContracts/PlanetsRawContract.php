<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams;
use DemoAPIScalarGalaxy\Planets\PlanetListParams;
use DemoAPIScalarGalaxy\Planets\PlanetListResponse;
use DemoAPIScalarGalaxy\Planets\PlanetUpdateParams;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageParams;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageResponse;
use DemoAPIScalarGalaxy\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
interface PlanetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PlanetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet>
     *
     * @throws APIException
     */
    public function create(
        array|PlanetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet>
     *
     * @throws APIException
     */
    public function retrieve(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param array<string,mixed>|PlanetUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet>
     *
     * @throws APIException
     */
    public function update(
        int $planetID,
        array|PlanetUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PlanetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PlanetListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PlanetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param array<string,mixed>|PlanetUploadImageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PlanetUploadImageResponse>
     *
     * @throws APIException
     */
    public function uploadImage(
        int $planetID,
        array|PlanetUploadImageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
