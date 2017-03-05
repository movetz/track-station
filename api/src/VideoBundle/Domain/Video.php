<?php

namespace VideoBundle\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Domain\User;

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
     * @ORM\Column(type="string", length=8, options={"fixed" = true})
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
    private $description = '';

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $duration = 0;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $size = 0;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $format;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Domain\User", inversedBy="recipes")
     */
    private $owner;

    /**
     * @var Tag[]
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * Video constructor.
     * @param string $uid
     * @param string $name
     * @param string $description
     * @param array $tags
     * @param User $owner
     */
    public function __construct(string $uid, string $name, string $description, array  $tags, User $owner) {
        $this->uid = $uid;
        $this->name = $name;
        $this->description = $description;
        $this->tags = new ArrayCollection($tags);
        $this->owner = $owner;

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