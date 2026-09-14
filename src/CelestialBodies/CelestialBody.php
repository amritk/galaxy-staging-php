<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\CelestialBodies;

use DemoAPIScalarGalaxy\Core\Concerns\SdkUnion;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\Converter;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\ConverterSource;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\Satellite;

/**
 * A celestial body which can be either a planet or a satellite.
 *
 * @phpstan-import-type PlanetShape from \DemoAPIScalarGalaxy\Planets\Planet
 * @phpstan-import-type SatelliteShape from \DemoAPIScalarGalaxy\Planets\Satellite
 *
 * @phpstan-type CelestialBodyVariants = Planet|Satellite
 * @phpstan-type CelestialBodyShape = CelestialBodyVariants|PlanetShape|SatelliteShape
 */
final class CelestialBody implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['planet' => Planet::class, 'satellite' => Satellite::class];
    }
}
