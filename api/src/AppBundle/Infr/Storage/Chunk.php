<?php


namespace AppBundle\Infr\Storage;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Chunk
 * @package AppBundle\Infr\Storage
 */
class Chunk
{
    const DEFAULT_SIZE = 8*1024*1024;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var int
     */
    private $number;

    /**
     * @var int
     */
    private $offset;

    /**
     * Chunk constructor.
     * @param UploadedFile $file
     * @param string $transactionId
     * @param int $number
     * @param int $offset
     */
    public function __construct(UploadedFile $file, string $transactionId, int $number = 0, int $offset = 0)
    {
        $this->file = $file;
        $this->transactionId = $transactionId;
        $this->number = $number;
        $this->offset = $offset;
    }

    /**
     * @return resource
     */
    public function getStream()
    {
       return fopen($this->file->getRealPath(), 'r+');
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}