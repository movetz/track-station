<?php

namespace AppBundle\Infr\Storage\Contract;

use AppBundle\Infr\Storage\Chunk;
use AppBundle\Infr\Storage\UploadTransaction;

/**
 * Class ChunkUploader
 * @package AppBundle\Infr\Storage\Contract
 */
interface ChunkUploader
{
    /**
     * @param string $root
     * @param string $fileName
     * @param int $fileSize
     * @return UploadTransaction
     */
    public function startUpload(string $root, string $fileName, int $fileSize): UploadTransaction;

    /**
     * @param string $root
     * @param Chunk $chunk
     * @return UploadTransaction
     */
    public function uploadChunk(string $root, Chunk $chunk): UploadTransaction;

    /**
     * @param string $root
     * @param UploadTransaction $transaction
     * @return mixed
     */
    public function commit(string $root, UploadTransaction $transaction);
}