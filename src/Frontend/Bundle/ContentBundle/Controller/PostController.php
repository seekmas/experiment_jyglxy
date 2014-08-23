<?php

namespace Frontend\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Comment;
use Admin\Bundle\ContentBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function indexAction(Request $request , $category_id)
    {

        $posts = $this->get('post.repository')->findBy(
            array('categoryId' => $category_id)
        );

        $category = $this->get('category.repository')->find( $category_id );

        return $this->render('FrontendContentBundle:Post:index/index.html.twig' ,
            array(
                'category' => $category ,
                'posts' => $posts
            )
        );
    }

    public function displayAction(Request $request ,  $post_id )
    {

        $post = $this->get('post.repository')->find( $post_id );

        if( $post === NULL)
        {
            throw new \Exception('找不到文章');
        }

        $em = $this->getDoctrine()->getManager();
        $comment = new Comment();
        $comment->setPost( $post );
        $em->persist( $comment );

        $form = $this->createForm( new CommentType() , $comment);
        $form->handleRequest( $request);

        if( $form->isValid() )
        {
            $comment->setUser( $this->get('security.context')->getToken()->getUser() );
            $comment->setCreatedAt( new \Datetime());

            $em->flush();

            return $this->redirect(
                $this->generateUrl('display_post_by_id' , array('post_id'=>$post_id) )
            );
        }
        $query = $this->get('comment.repository')
            ->createQueryBuilder('c')
            ->select('c')
            ->where('c.postId = '.$post_id)
            ->orderBy('c.id' , 'desc')
            ->getQuery();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10
        );




        return $this->render('FrontendContentBundle:Post:display/index.html.twig' ,
            array(
                'post' => $post ,
                'comments' => $pagination ,
                'form' => $form->createView() ,
            )
        );
    }

}
