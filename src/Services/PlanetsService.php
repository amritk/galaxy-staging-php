<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Core\FileParam;
use DemoAPIScalarGalaxy\Core\Util;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\Planets\PlanetCreateParams\Type;
use DemoAPIScalarGalaxy\Planets\PlanetListResponse;
use DemoAPIScalarGalaxy\Planets\PlanetUploadImageResponse;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\PlanetsContract;

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
final class PlanetsService implements PlanetsContract
{
    /**
     * @api
     */
    public PlanetsRawService $raw;

    /**
     * @internal
     */
    public function __construct(
        private Client $client,
    ) {
        $this->raw = new PlanetsRawService($client);
    }

    /**
     * @api
     *
     * Time to play god and create a new planet. What do you think? Ah, don't think too much. What could go wrong anyway?
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
    ): Planet {
        $params = Util::removeNulls([
            'name' => $name,
            'type' => $type,
            'atmosphere' => $atmosphere,
            'creator' => $creator,
            'description' => $description,
            'discoveredAt' => $discoveredAt,
            'failureCallbackURL' => $failureCallbackURL,
            'habitabilityIndex' => $habitabilityIndex,
            'image' => $image,
            'physicalProperties' => $physicalProperties,
            'satellites' => $satellites,
            'successCallbackURL' => $successCallbackURL,
            'tags' => $tags,
        ]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * You'll better learn a little bit more about the planets. It might come in handy once space travel is available for everyone.
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): Planet {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(
            $planetID,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Sometimes you make mistakes, that's fine. No worries, you can update all planets.
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
    ): Planet {
        $params = Util::removeNulls([
            'name' => $name,
            'type' => $type,
            'atmosphere' => $atmosphere,
            'creator' => $creator,
            'description' => $description,
            'discoveredAt' => $discoveredAt,
            'failureCallbackURL' => $failureCallbackURL,
            'habitabilityIndex' => $habitabilityIndex,
            'image' => $image,
            'physicalProperties' => $physicalProperties,
            'satellites' => $satellites,
            'successCallbackURL' => $successCallbackURL,
            'tags' => $tags,
        ]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update(
            $planetID,
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * It's easy to say you know them all, but do you really? Retrieve all the planets and check whether you missed one.
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
    ): PlanetListResponse {
        $params = Util::removeNulls(['limit' => $limit, 'offset' => $offset]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This endpoint was used to delete planets. Unfortunately, that caused a lot of trouble for planets with life. So, this endpoint is now deprecated and should not be used anymore.
     *
     * @param int $planetID The ID of the planet to get
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        int $planetID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(
            $planetID,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Got a crazy good photo of a planet? Share it with the world!
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
    ): PlanetUploadImageResponse {
        $params = Util::removeNulls(['image' => $image]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->uploadImage(
            $planetID,
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }
}
