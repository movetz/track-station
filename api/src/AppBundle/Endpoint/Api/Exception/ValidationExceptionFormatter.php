<?php

namespace AppBundle\Endpoint\Api\Exception;

use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class ValidationFormatter
 * @package AppBundle\Endpoint\Api\Exception
 */
class ValidationExceptionFormatter extends ExceptionFormatter
{
    /**
     * ValidationExceptionFormatter constructor.
     * @param ValidationException $exception
     */
    public function __construct(ValidationException $exception)
    {
        parent::__construct($exception);
    }

    /**
     * @return array
     */
    public function format(): array
    {
        $errors = array_map(function (ConstraintViolation $violation) {
            return [
                'field' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }, iterator_to_array($this->exception->getErrors()));

        return ['errors' => $errors];
    }
}