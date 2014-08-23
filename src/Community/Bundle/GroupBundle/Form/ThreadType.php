<?php

namespace Community\Bundle\GroupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ThreadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content' , 'textarea' , array('label' => '内容') )
            ->add('image' , 'file' , array('required' => false , 'label' => '上传图片' ))
            ->add('isRoleUser' , null , array('required' => false , 'label' => '是否只对会员可见'))
        ;

        $builder->add('submit' , 'submit' , array('label' => '发话题') );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Community\Bundle\GroupBundle\Entity\Thread'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'community_bundle_groupbundle_thread';
    }
}
