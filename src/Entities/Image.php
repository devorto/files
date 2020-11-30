<?php

namespace Devorto\Images\Entities;

use DateTimeInterface;
use Devorto\UniversallyUniqueIdentifier\UniversallyUniqueIdentifier;

/**
 * Class Image
 *
 * @package Devorto\Images\Entities
 */
class Image
{
    /**
     * @var UniversallyUniqueIdentifier
     */
    protected UniversallyUniqueIdentifier $uuid;

    /**
     * @var string
     */
    protected string $sha1;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $mimeType;

    /**
     * @var string|null
     */
    protected ?string $description;

    /**
     * @var DateTimeInterface
     */
    protected DateTimeInterface $created;

    /**
     * @var DateTimeInterface
     */
    protected DateTimeInterface $lastModified;

    /**
     * @var string|null
     */
    protected ?string $blob;

    /**
     * @return UniversallyUniqueIdentifier
     */
    public function getUuid(): UniversallyUniqueIdentifier
    {
        return $this->uuid;
    }

    /**
     * @param UniversallyUniqueIdentifier $uuid
     *
     * @return Image
     */
    public function setUuid(UniversallyUniqueIdentifier $uuid): Image
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getSha1(): string
    {
        return $this->sha1;
    }

    /**
     * @param string $sha1
     *
     * @return Image
     */
    public function setSha1(string $sha1): Image
    {
        $this->sha1 = $sha1;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Image
     */
    public function setName(string $name): Image
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return Image
     */
    public function setMimeType(string $mimeType): Image
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Image
     */
    public function setDescription(?string $description): Image
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param DateTimeInterface $created
     *
     * @return Image
     */
    public function setCreated(DateTimeInterface $created): Image
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getLastModified(): DateTimeInterface
    {
        return $this->lastModified;
    }

    /**
     * @param DateTimeInterface $lastModified
     *
     * @return Image
     */
    public function setLastModified(DateTimeInterface $lastModified): Image
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBlob(): ?string
    {
        return $this->blob;
    }

    /**
     * @param string|null $blob
     *
     * @return Image
     */
    public function setBlob(?string $blob): Image
    {
        $this->blob = $blob;

        return $this;
    }
}
