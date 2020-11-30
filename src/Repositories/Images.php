<?php

namespace Devorto\Images\Repositories;

use Devorto\Images\Collections\ImageCollection;
use Devorto\Images\Entities\Image;
use Devorto\UniversallyUniqueIdentifier\UniversallyUniqueIdentifier;

/**
 * Interface Images
 *
 * @package Devorto\Images\Repositories
 */
interface Images
{
    /**
     * @param UniversallyUniqueIdentifier $id
     * @param bool $loadBlob
     *
     * @return Image|null
     */
    public function getByUuid(UniversallyUniqueIdentifier $id, bool $loadBlob = false): ?Image;

    /**
     * @param string $sha1
     * @param bool $loadBlob
     *
     * @return Image|null
     */
    public function getBySha1(string $sha1, bool $loadBlob = false): ?Image;

    /**
     * @return ImageCollection
     */
    public function getAll(): ImageCollection;

    /**
     * @param Image $image
     *
     * @return Image
     */
    public function save(Image $image): Image;

    /**
     * @param Image $image
     */
    public function delete(Image $image): void;
}
