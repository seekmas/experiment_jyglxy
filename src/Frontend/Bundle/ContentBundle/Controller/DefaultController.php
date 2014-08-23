<?php

namespace Frontend\Bundle\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendContentBundle:Default:index.html.twig');
    }

    public function audioAction()
    {
        return $this->render('FrontendContentBundle:Default:audio.html.twig');
    }
}
