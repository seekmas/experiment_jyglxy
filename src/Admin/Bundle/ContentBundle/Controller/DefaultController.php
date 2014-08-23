<?php

namespace Admin\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Post;
use Admin\Bundle\ContentBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {



        return $this->render('AdminContentBundle:Default:index/index.html.twig');
    }

}