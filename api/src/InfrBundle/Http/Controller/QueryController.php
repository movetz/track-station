<?php

namespace InfrBundle\Http\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class QueryController
 * @package InfrBundle\Http\Controller
 */
class QueryController extends AbstractController
{
    /**
     * QueryController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}