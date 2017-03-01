<?php

namespace AppBundle\Endpoint\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractController
 * @package AppBundle\Endpoint\Api\Controller
 */
class AbstractController extends Controller
{
    /**
     *
     */
    protected function flush()
    {
        $this->get('doctrine.orm.entity_manager')->flush();
    }

    /**
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @param array $context
     * @return JsonResponse
     */
    protected function json($data, $status = 200, $headers = array(), $context = array()): JsonResponse
    {
        return new JsonResponse($data, $status, $headers, $context);
    }
}