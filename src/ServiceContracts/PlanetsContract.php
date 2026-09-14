<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Core\FileParam;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Type;
use DemoAPIScalarGalaxy\Planets\PlanetListResponse;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageResponse;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;

/**
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere
 * @phpstan-import-type UserShape from \DemoAPIScalarGalaxy\Authentication\User
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties
 * @phpstan-import-type SatelliteShape from \DemoAPIScalarGalaxy\Planets\Satellite
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Atmosphere as AtmosphereShape1
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\PhysicalProperties as PhysicalPropertiesShape1
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
interface PlanetsContract
{
    /**
     * @api
     *
     * @param Type|value-of<Type> $type
     * @param list<Atmosphere|AtmosphereShape> $atmosphere Atmospheric composition
     * @param User|UserShape $creator A user
     * @param string $failureCallbackURL URL which gets invoked upon a failed operation
     * @param float $habitabilityIndex A score from 0 to 1 indicating potential habitability
     * @param PhysicalProperties|PhysicalPropertiesShape $physicalProperties
     * @param list<Satellite|SatelliteShape> $satellites
     * @param string $successCallbackURL URL which gets invoked upon a successful operation
     * @param list<string> $tags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Type|string $type,
        ?array $atmosphere = null,
        User|array|null $creator = null,
        ?string $description = null,
        ?\DateTimeInterface $discoveredAt = null,
        ?string $failureCallbackURL = null,
        ?float $habitabilityIndex = null,
        ?string $image = null,
        PhysicalProperties|array|null $physicalProperties = null,
        ?array $satellites = null,
        ?string $successCallbackURL = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): Planet;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): Planet;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Type|value-of<\DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Type> $type
     * @param list<\DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Atmosphere|AtmosphereShape1> $atmosphere Atmospheric composition
     * @param User|UserShape $creator A user
     * @param string $failureCallbackURL URL which gets invoked upon a failed operation
     * @param float $habitabilityIndex A score from 0 to 1 indicating potential habitability
     * @param \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\PhysicalProperties|PhysicalPropertiesShape1 $physicalProperties
     * @param list<Satellite|SatelliteShape> $satellites
     * @param string $successCallbackURL URL which gets invoked upon a successful operation
     * @param list<string> $tags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        int $planetID,
        string $name,
        \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\Type|string $type,
        ?array $atmosphere = null,
        User|array|null $creator = null,
        ?string $description = null,
        ?\DateTimeInterface $discoveredAt = null,
        ?string $failureCallbackURL = null,
        ?float $habitabilityIndex = null,
        ?string $image = null,
        \DemoAPIScalarGalaxy\Planets\PlanetUpdateParams\PhysicalProperties|array|null $physicalProperties = null,
        ?array $satellites = null,
        ?string $successCallbackURL = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): Planet;

    /**
     * @api
     *
     * @param int $limit The number of items to return
     * @param int $offset The number of items to skip before starting to collect the result set
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        int $limit = 10,
        int $offset = 0,
        RequestOptions|array|null $requestOptions = null,
    ): PlanetListResponse;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param int $planetID The ID of the planet to get
     * @param string|FileParam $image The image file to upload
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function uploadImage(
        int $planetID,
        string|FileParam|null $image = null,
        RequestOptions|array|null $requestOptions = null,
    ): PlanetUploadImageResponse;
}
