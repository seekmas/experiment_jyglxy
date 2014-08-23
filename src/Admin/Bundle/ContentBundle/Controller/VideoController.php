<?php

namespace Admin\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Post;
use Admin\Bundle\ContentBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller
{
    public function indexAction( Request $request)
    {

        return $this->render('AdminContentBundle:Video:index/index.html.twig');
    }

}