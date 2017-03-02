<?php

namespace AppBundle\Model\Domain\Video;

use AppBundle\Infr\Storage\Chunk;
use AppBundle\Infr\Storage\Contract\ChunkUploader;
use AppBundle\Infr\Storage\UploadTransaction;


/**
 * Class VideoUploader
 * @package AppBundle\Model\Domain\Video
 */
class VideoUploader
{
    /**
     * @var
     */
    private $uploader;

    private const ROOT = 'video';

    private const FILE_PREFIX = 'v_';

    /**
     * VideoUploader constructor.
     * @param ChunkUploader $uploader
     */
    public function __construct(ChunkUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param Video $video
     * @return UploadTransaction
     */
    public function startUpload(Video $video): UploadTransaction
    {
        $fileName = self::FILE_PREFIX.$video->getUid();
        return $this->uploader->startUpload(self::ROOT, $fileName, $video->getSize());
    }

    public function uploadChunk(Chunk $chunk): UploadTransaction
    {

    }
}