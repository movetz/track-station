<?php

namespace AppBundle\Model\Domain\Video;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity()
 * @ORM\Table(name="videos")
 */
class Video
{
    const STATUS_ADDED = 1;
    const STATUS_UPLOADING = 2;
    const STATUS_PROCESSING = 3;
    const STATUS_READY = 4;

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="guid", unique=true)
     */
    private $uid;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var
     */
    private $duration;

    private $owner;

    private $fileName;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $status;

    private $size;

    public function __construct(
        string $uid,
        string $name,
        string $description,
        int $size
    ) {
        $this->uid = $uid;
        $this->name = $name;
        $this->description = $description;
        $this->size = $size;
        $this->status = self::STATUS_ADDED;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}