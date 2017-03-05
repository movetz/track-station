<?php

namespace VideoBundle\Service;
use VideoBundle\Domain\TagRepository;
use VideoBundle\Domain\Video;
use VideoBundle\Domain\VideoRepository;

/**
 * Class CreateVideoHandler
 * @package AppBundle\Handler\Video
 */
class CreateVideoHandler
{
    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var VideoUploader
     */
    private $uploader;

    /**
     * CreateVideoHandler constructor.
     * @param VideoRepository $videoRepository
     * @param TagRepository $tagRepository
     * @param VideoUploader $uploader
     */
    public function __construct(VideoRepository $videoRepository, TagRepository $tagRepository, VideoUploader $uploader)
    {
        $this->videoRepository = $videoRepository;
        $this->tagRepository = $tagRepository;
        $this->uploader = $uploader;
    }

    /**
     * @param CreateVideoCommand $command
     * @return array
     */
    public function __invoke(CreateVideoCommand $command)
    {
        $video = new Video(
            $command->uid,
            $command->name,
            $command->description,
            $this->makeTags($command->tags),
            $command->user
        );

        $this->videoRepository->add($video);

        return $this->uploader->register($video);
    }

    private function makeTags(array $tags): array
    {
        $tags = array_unique($tags);

        return array_map(function ($tagName) {
            return $this->tagRepository->getTag($tagName);
        }, $tags);
    }
}