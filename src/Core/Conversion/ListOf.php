<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Core\Conversion;

use DemoAPIScalarGalaxy\Core\Conversion\Concerns\ArrayOf;
use DemoAPIScalarGalaxy\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
