<?php

namespace Admin\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('course' , 'entity' , array('class' => 'Admin\Bundle\ContentBundle\Entity\Course' ) )
            ->add('content')
            ->add('mp4File' , null , array('required' => false ))
            ->add('image' , 'file' , array('required' => false ))
            ->add('isEnabled' , null , array('required' => false ))
            ->add('orderId' , null , array('required' => false ))
        ;

        $builder->add('submit' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\Bundle\ContentBundle\Entity\Play'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_bundle_contentbundle_play';
    }
}
