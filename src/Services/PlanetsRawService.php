<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Core\FileParam;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Type;
use DemoAPIScalarGalaxy\Planets\PlanetListParams;
use DemoAPIScalarGalaxy\Planets\PlanetListResponse;
use DemoAPIScalarGalaxy\Planets\PlanetUpdateParams;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageParams;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageResponse;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\PlanetsRawContract;

/**
 * Everything about planets.
 *
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere
 * @phpstan-import-type UserShape from \DemoAPIScalarGalaxy\Authentication\User
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties
 * @phpstan-import-type SatelliteShape from \DemoAPIScalarGalaxy\Planets\Satellite
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Atmosphere as AtmosphereShape1
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\PhysicalProperties as PhysicalPropertiesShape1
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
final class PlanetsRawService implements PlanetsRawContract
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
     * Time to play god and create a new planet. What do you think? Ah, don't think too much. What could go wrong anyway?
     *
     * @param array{
     *   name: string,
     *   type: Type|value-of<Type>,
     *   atmosphere?: list<Atmosphere|AtmosphereShape>,
     *   creator?: User|UserShape,
     *   description?: string|null,
     *   discoveredAt?: \DateTimeInterface,
     *   failureCallbackURL?: string,
     *   habitabilityIndex?: float,
     *   image?: string|null,
     *   physicalProperties?: PhysicalProperties|PhysicalPropertiesShape,
     *   satellites?: list<Satellite|SatelliteShape>,
     *   successCallbackURL?: string,
     *   tags?: list<string>,
     * }|PlanetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet>
     *
     * @throws APIException
     */
    public function create(
        array|PlanetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PlanetCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'planets',
            body: (object) $parsed,
            options: $options,
            convert: Planet::class,
        );
    }

    /**
     * @api
     *
     * You'll better learn a little bit more about the planets. It might come in handy once space travel is available for everyone.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['planets/%1$s', $planetID],
            options: $requestOptions,
            convert: Planet::class,
        );
    }

    /**
     * @api
     *
     * Sometimes you make mistakes, that's fine. No worries, you can update all planets.
     *
     * @param int $planetID The ID of the planet to get
     * @param array{
     *   name: string,
     *   type: \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Type|value-of<\DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Type>,
     *   atmosphere?: list<\DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Atmosphere|AtmosphereShape1>,
     *   creator?: User|UserShape,
     *   description?: string|null,
     *   discoveredAt?: \DateTimeInterface,
     *   failureCallbackURL?: string,
     *   habitabilityIndex?: float,
     *   image?: string|null,
     *   physicalProperties?: \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\PhysicalProperties|PhysicalPropertiesShape1,
     *   satellites?: list<Satellite|SatelliteShape>,
     *   successCallbackURL?: string,
     *   tags?: list<string>,
     * }|PlanetUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = PlanetUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['planets/%1$s', $planetID],
            body: (object) $parsed,
            options: $options,
            convert: Planet::class,
        );
    }

    /**
     * @api
     *
     * It's easy to say you know them all, but do you really? Retrieve all the planets and check whether you missed one.
     *
     * @param array{limit?: int, offset?: int}|PlanetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PlanetListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PlanetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PlanetListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'planets',
            query: $parsed,
            options: $options,
            convert: PlanetListResponse::class,
        );
    }

    /**
     * @api
     *
     * This endpoint was used to delete planets. Unfortunately, that caused a lot of trouble for planets with life. So, this endpoint is now deprecated and should not be used anymore.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['planets/%1$s', $planetID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Got a crazy good photo of a planet? Share it with the world!
     *
     * @param int $planetID The ID of the planet to get
     * @param array{image?: string|FileParam}|PlanetUploadImageParams $params
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
    ): BaseResponse {
        [$parsed, $options] = PlanetUploadImageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['planets/%1$s/image', $planetID],
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: PlanetUploadImageResponse::class,
        );
    }
}
