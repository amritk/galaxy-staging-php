<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Internal Server Exception';
}
