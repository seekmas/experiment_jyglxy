<?php

namespace Admin\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Post;
use Admin\Bundle\ContentBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function indexAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $post = new Post();

        $em->persist( $post );

        $form = $this->createForm( new PostType() , $post );

        $form->handleRequest( $request);

        if( $form->isValid() )
        {
            $em->flush();
        }

        return $this->render('AdminContentBundle:Post:index/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );
    }

    public function editAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $this->get('post.repository')->find( $id);
        $em->persist( $post );

        $tmp_image = $post->getImage();
        $post->setImage( NULL );

        $form = $this->createForm( new PostType() , $post );

        $form->handleRequest( $request );

        if( $form->isValid())
        {
            $data = $form->getData();

            $image = $data->getImage();


            if( $image )
            {

                if( $tmp_image )
                {
                    $this->get('file.save_file_handler')->remove( $tmp_image );
                }

                $image = $this->get('file.save_file_handler')->save( $post->getImage() , 'postImage' );

                $post->setImage( $image );


            }else
            {
                $post->setImage( $tmp_image );
            }


            $em->flush();
        }


        return $this->render('AdminContentBundle:Post:edit/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );

    }

    public function listAction()
    {

        $posts = $this->get('post.repository')->findAll();

        return $this->render('AdminContentBundle:Post:list/index.html.twig' ,
            array(
                'posts' => $posts ,
            )
        );
    }
}
