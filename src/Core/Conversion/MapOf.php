<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Core\Conversion;

use DemoAPIScalarGalaxy\Core\Conversion\Concerns\ArrayOf;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
