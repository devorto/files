<?php

namespace Devorto\Files\Repositories;

use Devorto\Files\Entities\File;

/**
 * Interface Images
 *
 * @package Devorto\Images\Repositories
 */
interface Files
{
    /**
     * Get File object using unique identifier.
     *
     * @param string $id Int or guid (should be unique).
     * @param bool $loadBlob Should object be loaded with blob (if false File->getBlob() returns null).
     *
     * @return File|null
     */
    public function getById(string $id, bool $loadBlob = false): ?File;

    /**
     * Get file using file hash.
     *
     * @param string $sha1 Sha1 (should be unique).
     * @param bool $loadBlob Should object be loaded with blob (if false File->getBlob() returns null).
     *
     * @return File|null
     */
    public function getBySha1(string $sha1, bool $loadBlob = false): ?File;

    /**
     * Saves object, after save a new object is given back including created/last modified etc.
     *
     * @param File $file Object to persist.
     * @param bool $loadBlob After save, include blob again or only basic data.
     *
     * @return File
     */
    public function save(File $file, bool $loadBlob = false): File;

    /**
     * Delete file, after this, passed object shouldn't be used anymore.
     *
     * @param File $file
     */
    public function delete(File $file): void;
}
