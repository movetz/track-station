<?php

namespace AppBundle\Endpoint\Api\ParamConverter;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DoubleDispatchParamConverter
 * @package AppBundle\Endpoint\Api\ParamConverter
 */
class DoubleDispatchParamConverter implements ParamConverterInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * DoubleDispatchParamConverter constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $serviceName = $this->resolveServiceName($configuration);
        $service = $this->container->get($serviceName);

        $request->attributes->set(
            $configuration->getName(),
            $service
        );
    }

    /**
     * @inheritdoc
     */
    public function supports(ParamConverter $configuration)
    {
        $serviceName = $this->resolveServiceName($configuration);
        return $this->container->has($serviceName);
    }

    /**
     * @param ParamConverter $configuration
     * @return string
     */
    private function resolveServiceName(ParamConverter $configuration): string
    {
        $options = $configuration->getOptions();
        return $options['name'];
    }
}
