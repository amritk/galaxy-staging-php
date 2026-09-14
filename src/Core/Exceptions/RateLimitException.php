<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Rate Limit Exception';
}
