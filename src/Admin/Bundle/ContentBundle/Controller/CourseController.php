<?php

namespace Admin\Bundle\ContentBundle\Controller;

use Admin\Bundle\ContentBundle\Entity\Course;
use Admin\Bundle\ContentBundle\Entity\CourseCategory;
use Admin\Bundle\ContentBundle\Entity\Play;
use Admin\Bundle\ContentBundle\Form\CourseCategoryType;
use Admin\Bundle\ContentBundle\Form\CourseType;
use Admin\Bundle\ContentBundle\Form\PlayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CourseController extends Controller
{

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $course = new Course();
        $em->persist( $course );

        $form = $this->createForm( new CourseType() , $course );

        $form->handleRequest( $request);

        if( $form->isValid() )
        {
            $em->flush();

            $course->setAlias( $this->get('course.global')->pinyin( $course->getTitle() ) . '_' . $course->getId() );

            $em->flush();
        }

        return $this->render( 'AdminContentBundle:Course:index/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );
    }

    public function listAction()
    {

        $courses = $this->get('course.repository')->findAll();


        return $this->render( 'AdminContentBundle:Course:list/index.html.twig' ,
            array(
                'courses' => $courses ,
            )
        );
    }

    public function categoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $courseCategory = new CourseCategory();

        $em->persist( $courseCategory );

        $form = $this->createForm( new CourseCategoryType() , $courseCategory);

        $form->handleRequest( $request);

        if( $form->isValid() )
        {
            $em->flush();
        }

        return $this->render( 'AdminContentBundle:Course:category/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );
    }

    public function editAction( Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $this->get('course.repository')->find( $id);
        $em->persist( $course );
        $tmp_image = $course->getImage();
        $course->setImage( NULL);
        $form = $this->createForm( new CourseType() , $course );
        $form->handleRequest( $request);

        if( $form->isValid() )
        {

            $course->setAlias( $this->get('course.global')->pinyin( $course->getTitle() ) . '_' . $course->getId() );

            $data = $form->getData();
            $image = $data->getImage();
            if( $image)
            {
                if( $tmp_image )
                {
                    $this->get('file.save_file_handler')->remove( $tmp_image );
                }
                $image = $this->get('file.save_file_handler')->save( $image , 'courseImage');
                $course->setImage( $image );
            }else
            {
                $course->setImage( $tmp_image );
            }
            $em->flush();
        }
        return $this->render( 'AdminContentBundle:Course:edit/index.html.twig' ,
            array(
                'form' => $form->createView() ,
                'tmp_image' => $tmp_image ,
            )
        );
    }

    public function playAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $play = new Play();
        $em->persist( $play);
        $form = $this->createForm( new PlayType() , $play );
        $form->handleRequest( $request);
        if( $form->isValid() )
        {

            $data = $form->getData();
            $image = $data->getImage();

            $imageFile = $this->get('file.save_file_handler')->save( $image , 'playImage');
            $play->setImage( $imageFile);

            $em->flush();
        }

        return $this->render( 'AdminContentBundle:Course:play/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );

    }

    public function playListAction()
    {
        $plays = $this->get('play.repository')->findAll();

        return $this->render( 'AdminContentBundle:Course:playList/index.html.twig' ,
            array(
                'plays' => $plays ,
            )
        );
    }

    public function playEditAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $play = $this->get('play.repository')->find( $id);
        $em->persist( $play);
        $tmp_image = $play->getImage();
        $play->setImage( NULL);


        $form = $this->createForm( new PlayType() , $play );
        $form->handleRequest( $request);

        if( $form->isValid())
        {
            $data = $form->getData();
            $image = $data->getImage();

            if( $image)
            {
                if( $tmp_image )
                {
                    $this->get('file.save_file_handler')->remove( $tmp_image);
                }



                $imageFile = $this->get('file.save_file_handler')->save( $image , 'playImage');
                $play->setImage( $imageFile);
            }else
            {
                $play->setImage( $tmp_image );
            }


            $em->flush();
        }

        return $this->render( 'AdminContentBundle:Course:playEdit/index.html.twig' ,
            array(
                'form' => $form->createView() ,
            )
        );
    }

    public function categoryListAction()
    {
        $categories = $this->get('courseCategory.repository')->findAll();

        return $this->render( 'AdminContentBundle:Course:category/list.html.twig' ,
            array(
                'categories' => $categories ,
            )
        );
    }

    public function editCategoryAction( Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categoory = $this->get('courseCategory.repository')->find( $id);

        $em->persist( $categoory );

        $tmp_image = $categoory->getImage();
        $categoory->setImage( NULL);

        $form = $this->createForm( new CourseCategoryType() , $categoory);

        $form->handleRequest( $request);



        if( $form->isValid())
        {
            $data = $form->getData();
            $image = $data->getImage();

            if( $image)
            {

                if( $tmp_image )
                {
                    $this->get('file.save_file_handler')->remove( $tmp_image);
                }

                $fileName = $this->get('file.save_file_handler')->save( $image , 'courseCategory' );
                $categoory->setImage( $fileName );

            }else
            {
                $categoory->setImage( $tmp_image );
            }

            $em->flush();

        }


        return $this->render(
            'AdminContentBundle:Course:editCategory/index.html.twig' ,
            array(
                'form' => $form->createView() ,
                'tmp_image' => $tmp_image ,
            )
        );
    }

    public function streamAction(Request $request)
    {
        $file = new File('/home/wwwroot/demo_1.wav');

        $container = $this->container;
        $response = new StreamedResponse(function() use( $container , $file){
            $handle = fopen( $file->getRealPath() , 'r');
            while( feof($handle) != NULL)
            {
                $buffer = fread( $handle , 1024);
                echo $buffer;
                flush();
            }
            fclose( $handle);
        });

        $response->headers->set('Content-Type' , $file->getMimeType());
        return $response;
    }
}