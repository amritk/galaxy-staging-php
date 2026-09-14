<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams;

enum Type: string
{
    case PLANET = 'planet';

    case TERRESTRIAL = 'terrestrial';

    case GAS_GIANT = 'gas_giant';

    case ICE_GIANT = 'ice_giant';

    case DWARF = 'dwarf';

    case SUPER_EARTH = 'super_earth';
}
