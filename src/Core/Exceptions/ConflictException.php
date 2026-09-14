<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Conflict Exception';
}
