<?php

namespace Admin\Bundle\ContentBundle\Controller;



use Community\Bundle\GroupBundle\Entity\Group;
use Community\Bundle\GroupBundle\Form\CategoryType;
use Community\Bundle\GroupBundle\Entity\Category;
use Community\Bundle\GroupBundle\Form\GroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommunityController extends Controller
{
    public function typeAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $em->persist( $category );
        $form = $this->createForm( new CategoryType() , $category);
        $form->handleRequest( $request );

        if( $form->isValid())
        {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success' , '添加成功');

            return $this->redirect( $this->generateUrl('community_type_add') );
        }

        $categories = $this->get('community_category.repository')->findAll();


        return $this->render(
            'AdminContentBundle:Community:type/index.html.twig' ,
            array(
                'form' => $form->createView() ,
                'categories' => $categories
            )
        );
    }

    public function groupAction( Request $request , $id = 0)
    {

        $em = $this->getDoctrine()->getManager();

        if( $id > 0 )
        {
            $group = $this->get('community_group.repository')->find( $id);

        }else
        {
            $group = new Group();
        }
        $tmp_image = $group->getImage();
        $group->setImage( NULL);

        $em->persist( $group );

        $form = $this->createForm( new GroupType() , $group );

        $form->handleRequest( $request );

        if( $form->isValid() )
        {

            $data = $form->getData();

            $image = $data->getImage();

            if( $image)
            {
                if( $tmp_image )
                {
                    $this->get('file.save_file_handler')->remove( $tmp_image);
                }

                $image = $this->get('file.save_file_handler')->save( $image , 'communityGroup' );

                $group->setImage( $image );

            }else
            {
                $group->setImage( $tmp_image);
            }

            $em->flush();
        }

        return $this->render(
            'AdminContentBundle:Community:group/index.html.twig' ,
            array(
                'form' => $form->createView() ,

            )
        );
    }

    public function groupListAction()
    {
        $groups = $this->get('community_group.repository')->findAll();
        return $this->render(
            'AdminContentBundle:Community:groupList/index.html.twig' ,
            array(
                'groups' => $groups ,

            )
        );
    }
}