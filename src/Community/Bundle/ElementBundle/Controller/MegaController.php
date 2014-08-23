<?php

namespace Community\Bundle\ElementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MegaController extends Controller
{
    public function indexAction()
    {

        $category = $this->get('community_category.repository')->findAll();

        return $this->render('CommunityElementBundle:Mega:index.html.twig' ,
            array(
                'category' => $category
            )
        );
    }

    public function userAction( $menu_title , $route = null , $id = null )
    {

        $user = $this->get('security.context')->getToken()->getUser();
        if( $user != 'anon.' )
        {
            $messages = $this->get('message.repository')->findBy(
                [
                    'toUserId' => $user->getId() ,
                    'isRead'   => false ,
                ]
            );
        }else
        {
            $messages = [];
        }



        return $this->render('CommunityElementBundle:Mega:user.html.twig' ,
            array(
                'menu_title' => $menu_title ,
                'route'      => $route ,
                'id'         => $id ,
                'messages'   => $messages
            )
        );
    }
}
