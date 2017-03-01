<?php


namespace AppBundle\Infr\Storage;

use AppBundle\Infr\Storage\Contract\ChunkUploader;
use Aws\S3\S3Client;

/**
 * Class ChunkUploader
 * @package AppBundle\Infr\Storage
 */
class S3ChunkUploader implements ChunkUploader
{
    /**
     * @var S3Client
     */
    private $client;

    /**
     * @var string
     */
    private $transactionStorage;

    /**
     * S3ChunkUploader constructor.
     * @param S3Client $client
     * @param UploadSessionStorage $transactionStorage
     */
    public function __construct(S3Client $client, UploadSessionStorage $transactionStorage)
    {
        $this->client = $client;
        $this->transactionStorage = $transactionStorage;
    }

    /**
     * @param string $root
     * @param string $fileName
     * @param int $fileSize
     * @return UploadTransaction
     */
    public function startUpload(string $root, string $fileName, int $fileSize): UploadTransaction
    {
        $response = $this->client->createMultipartUpload(array(
            'Bucket' => $root,
            'Key'    => $fileName
        ));

        $transaction = new UploadTransaction(
            $response['UploadId'],
            $fileName,
            1,
            $this->calculateTotalChunks($fileSize)
        );

        $this->transactionStorage->save($transaction);
        return $transaction;
    }

    public function uploadChunk(string $root, Chunk $chunk): UploadTransaction
    {
        $transaction = $this->transactionStorage->get($chunk->getTransactionId());

        $result = $this->client->uploadPart([
            'Bucket'     => $root,
            'Key'        => $transaction->getFileName(),
            'UploadId'   => $transaction->getId(),
            'PartNumber' => $transaction->processChunk(),
            'Body'       => $chunk->getStream(),
        ]);

        $this->transactionStorage->save($transaction);

        return $transaction;
    }

    public function commit(string $root, UploadTransaction $transaction)
    {

    }

    /**
     * @param int $fileSize
     * @return int
     */
    private function calculateTotalChunks(int $fileSize): int
    {
        return ceil($fileSize/Chunk::DEFAULT_SIZE);
    }
}