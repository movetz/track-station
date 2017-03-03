<?php

namespace InfrBundle\Http\Exception;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationException
 * @package AppBundle\Endpoint\Api\Exception
 */
class ValidationException extends RuntimeException
{
    /**
     * @var
     */
    private $errors;

    /**
     * ValidationException constructor.
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}