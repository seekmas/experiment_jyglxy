<?php

namespace Admin\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CourseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('image' , 'file' , array('required' => false ))
            ->add('category' , 'entity' , array('class' => 'Admin\Bundle\ContentBundle\Entity\CourseCategory') )
            ->add('content')
            ->add('videoPath' , null , array('required' => false ))
            ->add('enabled' , null , array('required' => false ) )
        ;

        $builder->add('submit' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\Bundle\ContentBundle\Entity\Course'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_bundle_contentbundle_course';
    }
}
