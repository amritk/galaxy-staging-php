<?php

namespace DemoAPIScalarGalaxy\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'DemoAPIScalarGalaxy Permission Denied Exception';
}
