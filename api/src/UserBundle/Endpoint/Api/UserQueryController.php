<?php

namespace UserBundle\Endpoint\Api;

use InfrBundle\Http\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Query\GetUserQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UserQueryController
 * @Route(service="app.user.query_controller")
 * @package UserBundle\Endpoint\Api
 */
class UserQueryController extends QueryController
{
    /**
     * @Route("/{uid}")
     *
     * @param string $uid
     * @return JsonResponse
     */
    public function getAction(string $uid)
    {
        $query = new GetUserQuery($this->get('doctrine.orm.default_entity_manager'));
        $query->byUid($uid);

        return $this->json($query->execute());
    }
}