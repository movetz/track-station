<?php

namespace InfrBundle\Http\EventListener;

use Exception;
use InfrBundle\Http\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Class ExceptionResponseListener
 * @package AppBundle\Endpoint\Api\EventListener
 */
class ExceptionResponseListener
{
    /**
     * @var array
     */
    private $exceptionMap = [];

    /**
     * ExceptionResponseListener constructor.
     * @param array $exceptionMap
     */
    public function __construct(array $exceptionMap)
    {
        $this->exceptionMap = $exceptionMap;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $className = get_class($exception);

        if (!array_key_exists($className, $this->exceptionMap)) {
            return;
        }

        //TODO: Make formatter more cleaner
        $metaData = $this->exceptionMap[$className];

        if (is_array($metaData)) {
            $responseCode = $metaData['status_code'];
            $formatterClassName = $metaData['formatter'];
        } else {
            $responseCode = $metaData;
            $formatterClassName = null;
        }



        //$responseData = $this->makeFormatter($exception, $formatterClassName)->format();
        //$responseData['status_code'] = $responseCode;

        $response = new JsonResponse([], $responseCode);

        $event->setResponse($response);
    }

    /**
     * @param Exception $exception
     * @param string|null $className
     * @return ExceptionFormatter
     */
//    private function makeFormatter(Exception $exception, string $className = null): ExceptionFormatter
//    {
//        return $className ? new $className($exception) : new ExceptionFormatter($exception);
//    }
}