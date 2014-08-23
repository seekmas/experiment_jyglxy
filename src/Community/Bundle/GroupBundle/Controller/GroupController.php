<?php

namespace Community\Bundle\GroupBundle\Controller;

use Community\Bundle\GroupBundle\CommunityEvents;
use Community\Bundle\GroupBundle\Entity\Group;
use Community\Bundle\GroupBundle\Entity\ReplyThread;
use Community\Bundle\GroupBundle\Entity\Thread;
use Community\Bundle\GroupBundle\Event\NewThreadEvent;
use Community\Bundle\GroupBundle\Event\ThreadEvent;
use Community\Bundle\GroupBundle\Form\GroupType;
use Community\Bundle\GroupBundle\Form\ReplyThreadType;
use Community\Bundle\GroupBundle\Form\ThreadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    public function indexAction( Request $request , $id)
    {

        $dispatcher = $this->get('event_dispatcher');
        $group = $this->get('community_group.repository')->find( $id);

        $em = $this->getDoctrine()->getManager();
        $new_thread = new Thread();
        $new_thread->setGroup( $group );
        $em->persist( $new_thread );
        $thread_form = $this->createForm( new ThreadType() , $new_thread );
        $thread_form->handleRequest( $request );

        $user = $this->get('security.context')->getToken()->getUser();

        if( $thread_form->isValid())
        {
            if( $user === 'anon.' )
            {
                $request->getSession()->getFlashBag()->add('danger' , '你还没登录 请先登录再发布话题');
                return $this->redirect(
                    $this->generateUrl('visit_group_by_id' , array('id' => $id) )
                );
            }

            if( $user->getMember() == NULL )
            {
                $request->getSession()->getFlashBag()->add('danger' , '你要先完善资料才能发话题');
                return $this->redirect(
                    $this->generateUrl( 'community_member' )
                );
            }

            $event = new NewThreadEvent( $request , $new_thread , $thread_form , $this->container );
            $dispatcher->dispath( CommunityEvents::PUBLISH_POST_SUBMIT , $event );

            $new_thread->setUser( $user );
            $new_thread->setCreatedAt( new \Datetime());

            $data = $thread_form->getData();
            $image = $data->getImage();

            if( $image )
            {
               $image = $this->get('file.save_file_handler')->save( $image , 'group/'.$id );
                $new_thread->setImage( $image );
            }

            $em->flush();

            $dispatcher->dispath( CommunityEvents::PUBLISH_POST_FINISHED , $event );

            $request->getSession()->getFlashBag()->add( 'success' , '发起话题成功');

            return $this->redirect(
                $this->generateUrl('visit_group_by_id' , array('id' => $id) )
            );
        }

        $query = $this->get('community_thread.repository')->createQueryBuilder('t')->select('t')->where('t.groupId = '.$id)->orderBy('t.createdAt' , 'desc')->getQuery();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10
        );

        return $this->render('CommunityGroupBundle:Group:index.html.twig', array(
            'group' => $group ,
            'form' => $thread_form->createView() ,
            'threads'=> $pagination
        ));
    }

    public function threadAction( Request $request , $id)
    {
        $dispatcher = $this->get('event_dispatcher');

        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $thread = $this->get('community_thread.repository')->find( $id);

        $em->persist( $thread);

        $group = $this->get('community_group.repository')->find( $thread->getGroupId() );

        $reply = new ReplyThread();

        $em->persist( $reply);

        $form = $this->createForm( new ReplyThreadType() , $reply);

        $form->handleRequest( $request);

        if( $form->isValid())
        {
            if( $user === 'anon.' )
            {
                $request->getSession()->getFlashBag()->add('danger' , '你还没登录 请先登录再回复');

                return $this->redirect(
                    $this->generateUrl('join_thread_by_id' , array('id' => $id) )
                );
            }

            if( $user->getMember() == NULL )
            {
                $request->getSession()->getFlashBag()->add('danger' , '你要先完善资料才能发话题');
                return $this->redirect(
                    $this->generateUrl( 'community_member' )
                );
            }
            $event = new ThreadEvent( $request , $thread , $reply , $form , $this->container );

            $dispatcher->dispatch( CommunityEvents::REPLY_POST_SUBMIT , $event );

            $reply->setContent( trim( $reply->getContent() ) );
            $data = $form->getData();
            $image = $data->getImage();

            if( $image)
            {
                $image = $this->get('file.save_file_handler')->save( $image , 'thread/' . $user->getId() . '/' . $id);
                $reply->setImage( $image);
            }

            $reply->setThread( $thread );
            $reply->setGroup( $group);
            $reply->setUser( $user);
            $reply->setCreatedAt( new \Datetime());
            $thread->setReplyNum( $thread->getReplyNum() + 1 );

            $em->flush();

            $dispatcher->dispatch( CommunityEvents::REPLY_POST_FINISHED , $event );

            $request->getSession()->getFlashBag()->add('success' , '回复成功' );

            return $this->redirect(
                $this->generateUrl('join_thread_by_id' , ['id' => $id])
            );
        }

        $reply = $this->get('community_reply_thread.repository')
                      ->createQueryBuilder('r')
                      ->select('r')
                      ->where('r.threadId = '.$id)
                      ->getQuery();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $reply,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );



        return $this->render('CommunityGroupBundle:Group:thread/index.html.twig' ,
            [
                'thread' => $thread ,
                'form'   => $form->createView() ,
                'replies'       => $pagination ,
                'page' => $this->get('request')->query->get('page', 1) ,
            ]
        );
    }
}
