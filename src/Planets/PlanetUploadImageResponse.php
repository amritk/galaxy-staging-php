<?php

declare(strict_types=1);

namespace DemoAPIScalarGalaxy\Planets;

use DemoAPIScalarGalaxy\Core\Attributes\Optional;
use DemoAPIScalarGalaxy\Core\Concerns\SdkModel;
use DemoAPIScalarGalaxy\Core\Contracts\BaseModel;

/**
 * @phpstan-type PlanetUploadImageResponseShape = array{
 *   fileSize?: int|null,
 *   imageURL?: string|null,
 *   message?: string|null,
 *   mimeType?: string|null,
 *   uploadedAt?: \DateTimeInterface|null,
 * }
 */
final class PlanetUploadImageResponse implements BaseModel
{
    /** @use SdkModel<PlanetUploadImageResponseShape> */
    use SdkModel;

    /**
     * Size of the uploaded image in bytes.
     */
    #[Optional]
    public ?int $fileSize;

    /**
     * The URL where the uploaded image can be accessed.
     */
    #[Optional('imageUrl')]
    public ?string $imageURL;

    #[Optional]
    public ?string $message;

    /**
     * The content type of the uploaded image.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Timestamp when the image was uploaded.
     */
    #[Optional]
    public ?\DateTimeInterface $uploadedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $fileSize = null,
        ?string $imageURL = null,
        ?string $message = null,
        ?string $mimeType = null,
        ?\DateTimeInterface $uploadedAt = null,
    ): self {
        $self = new self();

        null !== $fileSize && ($self['fileSize'] = $fileSize);
        null !== $imageURL && ($self['imageURL'] = $imageURL);
        null !== $message && ($self['message'] = $message);
        null !== $mimeType && ($self['mimeType'] = $mimeType);
        null !== $uploadedAt && ($self['uploadedAt'] = $uploadedAt);

        return $self;
    }

    /**
     * Size of the uploaded image in bytes.
     */
    public function withFileSize(int $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }

    /**
     * The URL where the uploaded image can be accessed.
     */
    public function withImageURL(string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * The content type of the uploaded image.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Timestamp when the image was uploaded.
     */
    public function withUploadedAt(\DateTimeInterface $uploadedAt): self
    {
        $self = clone $this;
        $self['uploadedAt'] = $uploadedAt;

        return $self;
    }
}
