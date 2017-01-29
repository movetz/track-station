<?php

namespace AppBundle\Endpoint\Api\Controller;

use AppBundle\Domain\User\Query\GetUserQuery;
use AppBundle\Handler\User\CreateUserCommand;
use AppBundle\Handler\User\CreateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package AppBundle\Endpoint\Http\Controller
 */
class UserController extends Controller
{
    /**
     * @Config\Route("/users")
     * @Config\Method("POST")
     *
     * @param CreateUserCommand $command
     * @param CreateUserHandler $handler
     * @param GetUserQuery $userQuery
     *
     * @return JsonResponse
     */
    public function create(CreateUserCommand $command, CreateUserHandler $handler, GetUserQuery $userQuery)
    {
        $command->uid = uniqid();

        $handler($command);
        $this->get('doctrine.orm.entity_manager')->flush();

        return new JsonResponse($userQuery->execute($command->uid));
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