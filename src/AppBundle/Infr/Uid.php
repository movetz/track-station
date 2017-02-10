<?php

namespace AppBundle\Infr;

use Hashids\Hashids;
use Ramsey\Uuid\Uuid;

/**
 * Class Uid
 * @package AppBundle\Infr
 */
class Uid
{
    /**
     * @return string
     */
    public static function make()
    {
        $encoder = new Hashids(Uuid::uuid4()->toString());
        return $encoder->encode(1, 2, 3, 4);
    }
}