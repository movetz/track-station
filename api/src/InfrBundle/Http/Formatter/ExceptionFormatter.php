<?php

namespace InfrBundle\Htpp\Formatter;

use Exception;

/**
 * Class ExceptionFormatter
 * @package AppBundle\Endpoint\Api\Exception
 */
class ExceptionFormatter
{
    /**
     * @var Exception
     */
    protected $exception;

    /**
     * ExceptionFormatter constructor.
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return [
            'code'    => $this->exception->getCode(),
            'message' => $this->exception->getMessage()
        ];
    }
}