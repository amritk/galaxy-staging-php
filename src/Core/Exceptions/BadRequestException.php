<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Bad Request Exception';
}
