<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBody;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Orbit;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Type;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\CelestialBodiesRawContract;

/**
 * Celestial bodies are the planets and satellites in the Scalar Galaxy.
 *
 * @phpstan-import-type AtmosphereShape from \DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Atmosphere
 * @phpstan-import-type UserShape from \DemoAPIScalarGalaxy\Authentication\User
 * @phpstan-import-type PhysicalPropertiesShape from \DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\PhysicalProperties
 * @phpstan-import-type SatelliteShape from \DemoAPIScalarGalaxy\Planets\Satellite
 * @phpstan-import-type OrbitShape from \DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Orbit
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
final class CelestialBodiesRawService implements CelestialBodiesRawContract
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
     * Create a celestial body
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
     *   diameter?: float,
     *   orbit?: Orbit|OrbitShape,
     * }|CelestialBodyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet|Satellite>
     *
     * @throws APIException
     */
    public function create(
        array|CelestialBodyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CelestialBodyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'celestial-bodies',
            body: (object) $parsed,
            options: $options,
            convert: CelestialBody::class,
        );
    }
}
