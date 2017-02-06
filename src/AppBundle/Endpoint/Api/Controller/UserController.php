<?php

namespace AppBundle\Endpoint\Api\Controller;

use AppBundle\Handler\User\{
    CreateUserCommand,
    CreateUserHandler
};
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class UserController
 * @package AppBundle\Endpoint\Http\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Config\Route("/users")
     * @Config\Method("POST")
     *
     * @Config\ParamConverter("command", converter="command_mapper", options={ "auto_uid" : "uid" })
     * @Config\ParamConverter("handler", converter="dd_resolver", options={ "name" : "app.handler.user.create" })
     *
     * @param CreateUserCommand $command
     * @param CreateUserHandler $handler
     * @return JsonResponse
     */
    public function create(CreateUserCommand $command, CreateUserHandler $handler)
    {
        $handler($command);
        $this->flush();

        //return $this->json($userQuery->execute($command->uid));
    }

    /**
     * @Config\Route("/users")
     * @Config\Method("GET")
     */
    public function show()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}