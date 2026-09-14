<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\ServiceContracts;

use DemoAPIScalarGalaxy\CelestialBodies\CelestialBodyCreateParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseResponse;
use DemoAPIScalarGalaxy\Core\Exceptions\APIException;
use DemoAPIScalarGalaxy\Planets\Planet;
use DemoAPIScalarGalaxy\Planets\Satellite;
use DemoAPIScalarGalaxy\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \DemoAPIScalarGalaxy\RequestOptions
 */
interface CelestialBodiesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CelestialBodyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Planet|Satellite>
     *
     * @throws APIException
     */
    public function create(
        array|CelestialBodyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
