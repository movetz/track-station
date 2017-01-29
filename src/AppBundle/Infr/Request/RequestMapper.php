<?php

namespace AppBundle\Infr\Request;

use ReflectionObject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestMapper
 * @package AppBundle\Infr\Request
 */
class RequestMapper implements ParamConverterInterface
{
    /**
     * @inheritdoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $class = $configuration->getClass();
        $command = new $class;

        $reflect = new ReflectionObject($command);

        $payload = $this->transformRequest($request);
        foreach ($reflect->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
            $propertyName = $prop->getName();
            if (array_key_exists($propertyName, $payload)) {
                $command->{$propertyName} = $payload[$propertyName];
            }
        }

        $request->attributes->set(
            $configuration->getName(),
            $command
        );
    }

    /**
     * @inheritdoc
     */
    public function supports(ParamConverter $configuration)
    {
        $className = $configuration->getClass();

        //TODO: Make more flexible solution
        return preg_match('/^.*Command/', $className) ? $className : null;
    }

    /**
     * @param Request $request
     * @return array $payload
     */
    private function transformRequest(Request $request): array
    {
        $requestBody = $request->getContent();
        $payload = json_decode($requestBody, true);

        return $payload;
    }
}