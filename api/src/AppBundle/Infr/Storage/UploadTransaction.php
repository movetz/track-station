<?php

namespace AppBundle\Infr\Storage;

/**
 * Class UploadTransaction
 * @package AppBundle\Infr\Storage
 */
class UploadTransaction
{

    const STATUS_STARTED = 'started';
    const STATUS_UPLOADING = 'uploading';
    const STATUS_READY = 'ready';

    private $id;

    private $offset;

    private $fileName;

    private $currentChunk;

    private $totalChunks;

    private $status;

    /**
     * UploadTransaction constructor.
     * @param string $id
     * @param string $fileName
     * @param int $currentChunk
     * @param int $totalChunks
     * @param int $offset
     */
    public function __construct(
        string $id,
        string $fileName,
        int $currentChunk,
        int $totalChunks,
        int $offset = 0
    ) {
        $this->id = $id;
        $this->fileName = $fileName;
        $this->currentChunk = $currentChunk;
        $this->totalChunks = $totalChunks;
        $this->offset = $offset;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $status
     */
    public function changeStatus(string $status)
    {
        //TODO: add exception
        $this->status = $status;
    }

    public function processChunk(): int
    {
        return $this->currentChunk++;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}