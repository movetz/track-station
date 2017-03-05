<?php

namespace VideoBundle\Service;

use Ramsey\Uuid\Uuid;
use VideoBundle\Domain\Video;

class VideoUploader
{
    public function register(Video $video)
    {
        return [
            'uid'           => $video->getUid(),
            'transactionId' => Uuid::uuid4()->toString(),
            'expires'       => time() + 12*400
        ];
    }
}