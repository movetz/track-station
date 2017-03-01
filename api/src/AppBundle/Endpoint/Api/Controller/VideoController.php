<?php

namespace AppBundle\Endpoint\Api\Controller;

use AppBundle\Handler\User\CreateUserHandler;
use AppBundle\Handler\Video\CreateVideoCommand;

use AppBundle\Handler\Video\CreateVideoHandler;
use AppBundle\Infr\Storage\Contract\ChunkUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class VideoController
 * @package AppBundle\Endpoint\Api\Controller
 */
class VideoController extends AbstractController
{
    /**
     * @Config\Route("/videos")
     * @Config\Method("POST")
     *
     * @Config\ParamConverter("command", converter="command_mapper", options={ "auto_uid" : "uid", "validation" : false  })
     * @Config\ParamConverter("handler", converter="dd_resolver", options={ "name" : "app.handler.video.create" })
     *
     * @param CreateVideoCommand $command
     * @param CreateVideoHandler $handler
     *
     * @return JsonResponse
     */
    public function createVideo(CreateVideoCommand $command, CreateVideoHandler $handler)
    {

        //$handler($command);

        return $this->json(['status' => 'done', 'name' => $command->name, 'uid' => $command->uid]);
    }

    /**
     * @Config\Route("/upload")
     * @Config\Method("POST")
     *
     * Config\ParamConverter("uploader", converter="dd_resolver", options={ "name" : "app.infr.storage_chuck_uploader" })
     *
     */
    public function upload(Request $request)
    {

        dump([$request->files, $_FILES, $request->files->get('chunk')]);
        exit;


        //$tr = $uploader->startUpload('video', 'test.flv', 876289000);
        dump($tr);
        exit;
    }


    /**
     * @Config\Route("/videos")
     * @Config\Method("GET")
     */
    public function getVideo()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}