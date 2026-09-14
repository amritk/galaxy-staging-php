<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets\Satellite;

enum Type: string
{
    case SATELLITE = 'satellite';

    case MOON = 'moon';

    case ASTEROID = 'asteroid';

    case COMET = 'comet';
}
