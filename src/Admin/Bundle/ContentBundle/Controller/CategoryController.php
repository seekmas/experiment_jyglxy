<?php

namespace Admin\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Category;
use Admin\Bundle\ContentBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function indexAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $em->persist( $category );
        $form = $this->createForm( new CategoryType() , $category );
        $form->handleRequest( $request );

        if( $form->isValid() )
        {

            $em->flush();
        }

        return $this->render('AdminContentBundle:Category:index/index.html.twig' , array( 'form' => $form->createView() ) );
    }

    public function listAction()
    {
        $categories = $this->get('category.repository')->findAll();


        return $this->render('AdminContentBundle:Category:list/index.html.twig',
            array(
                'categories' => $categories ,
            )
        );
    }

    public function editAction( Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();
        $category = $this->get('category.repository')->find( $id);
        $em->persist( $category );

        $tmp_image = $category->getImage();
        $category->setImage( NULL);
        $form = $this->createForm( new CategoryType() , $category );

        $form->handleRequest( $request);

        if( $form->isValid())
        {

            $data = $form->getData();
            $image = $data->getImage();

            if( $image && $tmp_image )
            {
                $this->get('file.save_file_handler')->remove( $tmp_image );
                $image = $this->get('file.save_file_handler')->save( $image , 'savedFile');

                $category->setImage( $image );
            }else
            {
                $category->setImage( $tmp_image );
            }

            $em->flush();
        }

        return $this->render('AdminContentBundle:Category:edit/index.html.twig' , array( 'form' => $form->createView() ) );

    }
}
