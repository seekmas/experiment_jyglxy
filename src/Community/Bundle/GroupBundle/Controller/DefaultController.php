<?php

namespace Community\Bundle\GroupBundle\Controller;

use Community\Bundle\GroupBundle\Entity\Group;
use Community\Bundle\GroupBundle\Entity\Member;
use Community\Bundle\GroupBundle\Form\GroupType;
use Community\Bundle\GroupBundle\Form\MemberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $group = new Group();

        $em->persist( $group );

        $form = $this->createForm( new GroupType() , $group );

        $form->handleRequest( $request );

        if( $form->isValid() )
        {

            $data = $form->getData();
            $image = $data->getImage();

            $image = $this->get('file.save_file_handler')->save( $image , 'communityGroup' );

            $group->setImage( $image );

            $em->flush();
        }


        $threads = $this->get('community_thread.repository')
                        ->createQueryBuilder('t')
                        ->select('t')
                        ->where('t.image is not NULL')
                        ->orderBy('t.id' , 'desc')
                        ->getQuery();
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $threads,
            $this->get('request')->query->get('page', 1)/*page number*/,
            4/*limit per page*/
        );


        return $this->render('CommunityGroupBundle:Default:index.html.twig', array(
            'form' => $form->createView() ,
            'threads' => $pagination
        ));
    }

    public function memberAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if( NULL == ( $member = $this->get('member.repository')->findOneByUserId( $user->getId() ) ) )
        {
            $member = new Member();
        }

        $tmp_image = $member->getImage();

        $member->setImage( NULL);

        $em->persist( $member);

        $form = $this->createForm( new MemberType() , $member );

        $form->handleRequest( $request);

        if( $form->isValid())
        {

            $member->setUser( $user );
            $data = $form->getData();
            $image = $data->getImage();

            if( $image)
            {
                $image = $this->get('file.save_file_handler')->save( $image , 'avatarUploads/'.$user->getId() );
                $member->setImage( $image);
            }else
            {
                $member->setImage( $tmp_image);
            }

            $em->flush();

            $request->getSession()->getFlashBag()->add('success' , '资料更新成功' );

            return $this->redirect(
                $this->generateUrl('community_member')
            );
        }

        return $this->render('CommunityGroupBundle:Default:member/index.html.twig' ,
            [
                'form' => $form->createView()
            ]
        );
    }
}
