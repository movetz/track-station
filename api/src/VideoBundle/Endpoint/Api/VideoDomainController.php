<?php

namespace VideoBundle\Endpoint\Api;

use InfrBundle\Http\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use VideoBundle\Service\{
    CreateVideoCommand, CreateVideoHandler
};
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;

class VideoDomainController extends AbstractController
{
    /**
     * @Config\Route("/videos")
     * @Config\Method("POST")
     *
     * @Config\Security("has_role('ROLE_USER')")
     *
     * @Config\ParamConverter("command", converter="command_mapper", options={ "auto_uid" : "uid", "auth" : "user" })
     * @Config\ParamConverter("handler", converter="dd_resolver", options={ "name" : "app.video.service.create_video" })
     *
     * @param CreateVideoCommand $command
     * @param CreateVideoHandler $handler
     * @return JsonResponse
     */
    public function createAction(CreateVideoCommand $command, CreateVideoHandler $handler)
    {
        $transaction = $handler($command);
        $this->flush();

        return $this->json($transaction, JsonResponse::HTTP_ACCEPTED);
    }

}