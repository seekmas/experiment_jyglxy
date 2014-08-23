<?php

namespace Frontend\Bundle\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CourseController extends Controller
{
    public function indexAction($category_id)
    {

        $courses = $this->get('course.repository')->findBy(
            [
                'categoryId' => $category_id ,
                'enabled'    => true
            ]
        );

        return $this->render('FrontendContentBundle:Course:index/index.html.twig' ,
            array(
                'courses' => $courses
            )
        );
    }

    public function listAction()
    {
        $categories = $this->get('courseCategory.repository')->findBy(array('enabled' => true));


        return $this->render('FrontendContentBundle:Course:list/index.html.twig' ,
            [
                'categories' => $categories ,
            ]
        );
    }

    public function displayAction( $course_id)
    {
        $course = $this->get('course.repository')->find( $course_id);

        if( $course === NULL)
        {
            throw new \Exception('课程没有找到');
        }

        //echo $this->get('course.global')->pinyin( $course->getTitle() );

        return $this->render('FrontendContentBundle:Course:display/index.html.twig' ,
            array(
                'course' => $course ,
            )
        );
    }

    public function playAction( $id)
    {

        $play = $this->get('play.repository')->find( $id);

        $course = $this->get('course.repository')->find( $play->getCourse()->getId() );

        if( $this->get('security.context')->getToken()->getUser() != 'anon.' )
        {
            $salt = $this->get('security.context')->getToken()->getUser()->getSalt();
        }else
        {
            $salt = 'anonymous';
        }

        return $this->render('FrontendContentBundle:Course:play/index.html.twig' ,
            array(
                'play' => $play ,
                'course' => $course ,
                'salt' => $salt ,
            )
        );
    }
}
