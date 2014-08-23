<?php

namespace Community\Bundle\GroupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReplyThreadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content' , 'textarea' , array('label' => '回复'))
            ->add('image' , 'file' , array('label' => '图片' , 'required' => false ) )
        ;

        $builder->add('submit' , 'submit' , array('label' => '回复') );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Community\Bundle\GroupBundle\Entity\ReplyThread'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'community_bundle_groupbundle_replythread';
    }
}
