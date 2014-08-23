<?php

namespace Community\Bundle\GroupBundle\Event;

use Community\Bundle\GroupBundle\Entity\ReplyThread;
use Community\Bundle\GroupBundle\Entity\Thread;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ThreadEvent extends GetResponseEvent
{
    private $request;
    private $thread;
    private $reply;
    private $form;
    private $service_container;
    private $response;

    public function __construct( Request $request , Thread $thread , ReplyThread $reply , Form $form , $service_container)
    {
        $this->request = $request;
        $this->thread = $thread;
        $this->reply = $reply;
        $this->form = $form;
        $this->service_container = $service_container;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function getContainer()
    {
        return $this->service_container;
    }

    public function getThread()
    {
        return $this->thread;
    }

    public function getReply()
    {
        return $this->reply;
    }

    public function getForm()
    {
        return $this->form;
    }
}