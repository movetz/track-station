<?php

namespace UserBundle\Endpoint\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Query\GetUserQuery;
use InfrBundle\Http\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UserQueryController
 * @Route(service="app.user.query_controller")
 * @package UserBundle\Endpoint\Api
 */
class UserQueryController extends AbstractController
{
    /**
     * @Route("/{id}")
     *
     * @param string $id
     * @return JsonResponse
     */
    public function getAction(string $id)
    {
        $query = new GetUserQuery();
        $query
            ->byId($id);

        return $this->json($query->execute());
    }
}