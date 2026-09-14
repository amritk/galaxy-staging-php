<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Core\Conversion\Contracts;

use DemoAPIScalarGalaxy\Core\Conversion\CoerceState;
use DemoAPIScalarGalaxy\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
