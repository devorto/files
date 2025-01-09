<?php

namespace Devorto\Files\Entities;

use DateTimeInterface;
use finfo;
use InvalidArgumentException;
use JsonSerializable;
use stdClass;

/**
 * Entity containing the data.
 */
class File implements JsonSerializable
{
    /**
     * @var string|null The ID for this file, can be an integer from database or uuid or something else unique.
     */
    protected ?string $id = null;

    /**
     * @var string Sha1 from blob (or array).
     */
    protected string $sha1;

    /**
     * @var string Name of the file (only these chars are kept a-z 0-9 - _ .) with extension.
     */
    protected string $name;

    /**
     * @var string Content type.
     */
    protected string $mimeType;

    /**
     * @var int|null In case of an image this can contain the width (optional).
     */
    protected ?int $width = null;

    /**
     * @var int|null In case of an image this can contain the height (optional).
     */
    protected ?int $height = null;

    /**
     * @var DateTimeInterface|null When was the entry created.
     */
    protected ?DateTimeInterface $created = null;

    /**
     * @var DateTimeInterface|null When was the entry changed last.
     */
    protected ?DateTimeInterface $lastModified = null;

    /**
     * @var string|null
     */
    protected ?string $blob;

    /**
     * @param array $data
     *
     * @return File
     */
    public static function fromArray(array $data): File
    {
        $image = new static();
        $image->id = $data['id'];
        $image->sha1 = $data['sha1'];
        $image->name = $data['name'];
        $image->mimeType = $data['mime_type'];
        $image->width = $data['width'] ?? null;
        $image->height = $data['height'] ?? null;
        $image->created = $data['created'];
        $image->lastModified = $data['last_modified'];
        $image->blob = $data['blob'] ?? null;

        return $image;
    }

    /**
     * @param string $file
     *
     * @return File|null Returns null on failure or File object on succes.
     */
    public static function fromFile(string $file): ?File
    {
        $path = realpath($file);
        if (empty($path)) {
            return null;
        }

        $blob = file_get_contents($path);
        if (empty($blob)) {
            return null;
        }

        $file = new static();
        $file->setBlob($blob);
        $file->setName(basename($path));

        return $file;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSha1(): string
    {
        return $this->sha1;
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
     * @return File
     */
    public function setName(string $name): File
    {
        $name = trim(preg_replace('/[^0-9a-z-_.]/i', '-', trim($name)), '-');
        if (empty($name)) {
            throw new InvalidArgumentException('Name cannot be an empty string.');
        }

        $this->name = strtolower($name);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLastModified(): ?DateTimeInterface
    {
        return $this->lastModified;
    }

    /**
     * @return string|null
     */
    public function getBlob(): ?string
    {
        return $this->blob;
    }

    /**
     * @param string $blob
     *
     * @return $this
     */
    public function setBlob(string $blob): File
    {
        if (empty($blob)) {
            throw new InvalidArgumentException('Blob cannot be an empty string.');
        }

        $this->blob = $blob;
        $this->sha1 = sha1($blob);
        $info = new finfo();
        $this->mimeType = $info->buffer($blob, FILEINFO_MIME_TYPE);
        if (str_starts_with($this->mimeType, 'image/')) {
            $sizes = getimagesizefromstring($this->blob);
            if (!empty($sizes)) {
                $this->width = $sizes[0];
                $this->height = $sizes[1];
            }
        }

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return stdClass data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize(): stdClass
    {
        $obj = new stdClass();
        $obj->id = $this->id;
        $obj->sha1 = $this->sha1;
        $obj->name = $this->name;
        $obj->mimeType = $this->mimeType;
        $obj->width = $this->width;
        $obj->height = $this->height;
        $obj->blob = $this->blob;
        $obj->created = empty($this->created)
            ? null
            : $this->created->format(DateTimeInterface::ATOM);
        $obj->lastModified = empty($this->lastModified)
            ? null
            : $this->lastModified->format(DateTimeInterface::ATOM);

        return $obj;
    }
}
