<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Unprocessable Entity Exception';
}
