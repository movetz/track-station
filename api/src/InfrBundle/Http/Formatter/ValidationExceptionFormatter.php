<?php

namespace InfrBundle\Http\Formatter;

use Symfony\Component\Validator\ConstraintViolation;
use InfrBundle\Http\Exception\ValidationException;

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