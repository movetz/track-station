<?php

namespace InfrBundle\Http\EventListener;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestBodyListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $data = json_decode($request->getContent(), true);
        $request->request = new ParameterBag($data);
    }
}