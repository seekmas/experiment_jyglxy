<?php

namespace Community\Bundle\GroupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request , $id)
    {



        $user = $this->get('user.repository')->find( $id);

        if( $user->getMember() == NULL )
        {

            $request->getSession()->getFlashBag()->add('danger' , '请先完善资料');

            return $this->redirect( $this->generateUrl( 'community_member') );
        }


        $threads = $this->get('community_thread.repository')
                        ->createQueryBuilder('thread')
                        ->select('thread')
                        ->where('thread.userId = '.$id)
                        ->orderBy('thread.id' , 'desc')
                        ->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $threads,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );

        $reply = $this->get('community_reply_thread.repository')->findByUserId( $id );

        return $this->render('CommunityGroupBundle:Home:index.html.twig',
            [
                'user'    => $user ,
                'threads' => $pagination ,
                'reply'   => $reply ,
                'thread'  => $this->get('community_thread.repository')->findByUserId( $id) ,
            ]
        );
    }
}
