<?php

namespace UserBundle\Endpoint\Api;

use Symfony\Component\HttpFoundation\Response;
use UserBundle\Service\{
    CreateUserCommand,
    CreateUserHandler
};
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use AppBundle\Endpoint\Api\Controller\AbstractController;

class UserDomainController extends AbstractController
{
    /**
     * @Config\Route("/")
     * @Config\Method("POST")
     *
     * @Config\ParamConverter("command", converter="command_mapper", options={ "auto_uid" : "uid"})
     * @Config\ParamConverter("handler", converter="dd_resolver", options={ "name" : "app.user.service.create_user" })
     *
     * @param CreateUserCommand $command
     * @param CreateUserHandler $handler
     * @return Response
     */
    public function createAction(CreateUserCommand $command, CreateUserHandler $handler)
    {
        $handler($command);


        //$this->flush();

        return $this->forward('app.user.query_controller:getAction', ['id' => $command->uid]);

        //return $this->json($userQuery->execute($command->uid));
    }
}