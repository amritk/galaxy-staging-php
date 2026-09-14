<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Concerns\SdkParams;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;
use DemoAPIScalarGalaxy\Core\FileParam;

/**
 * Got a crazy good photo of a planet? Share it with the world!
 *
 * @see DemoAPIScalarGalaxy\Services\PlanetsService::uploadImage()
 *
 * @phpstan-type PlanetUploadImageParamsShape = array{
 *   image?: string|null|FileParam
 * }
 */
final class PlanetUploadImageParams implements BaseModel
{
    /** @use SdkModel<PlanetUploadImageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The image file to upload.
     */
    #[Optional]
    public string|FileParam|null $image;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string|FileParam|null $image = null): self
    {
        $self = new self();

        null !== $image && ($self['image'] = $image);

        return $self;
    }

    /**
     * The image file to upload.
     */
    public function withImage(string|FileParam $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }
}
