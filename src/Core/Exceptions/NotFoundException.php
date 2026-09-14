<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Not Found Exception';
}
