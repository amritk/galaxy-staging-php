<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Services;

use DemoAPIScalarGalaxy\Authentication\User;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Atmosphere;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Orbit;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\PhysicalProperties;
use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams\Type;
use DemoAPIScalarGalaxy\Client;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Core\Util;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;
use DemoAPIScalarGalaxy\ServiceContracts\CelestialBodiesContract;

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
final class CelestialBodiesService implements CelestialBodiesContract
{
    /**
     * @api
     */
    public CelestialBodiesRawService $raw;

    /**
     * @internal
     */
    public function __construct(
        private Client $client,
    ) {
        $this->raw = new CelestialBodiesRawService($client);
    }

    /**
     * @api
     *
     * Create a celestial body
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
     * @param float $diameter Diameter in kilometers
     * @param Orbit|OrbitShape $orbit
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
        ?float $diameter = null,
        Orbit|array|null $orbit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Planet|Satellite {
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
            'diameter' => $diameter,
            'orbit' => $orbit,
        ]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(
            params: $params,
            requestOptions: $requestOptions,
        );

        return $response->parse();
    }
}
