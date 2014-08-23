<?php

namespace Community\Bundle\GroupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemberType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image' , 'file' , array('label' => '头像' , 'required' => false ) )
            ->add('realname' , 'text' , array('label' => '真实姓名' , 'required' => true) )
            ->add('nickname' , 'text' , array('label' => '社区昵称' , 'required' => true ) )
            ->add('phone' , 'text' , array('label' => '手机号' , 'required' => true ) )
            ->add('weibo' , 'text' , array('label' => '微博地址' , 'required' => false ) )
            ->add('job' , 'text' , array('label' => '工作' , 'required' => false ) )
            ->add('company' , 'text' , array('label' => '公司' , 'required' => false ) )
        ;

        $builder->add('submit' , 'submit' , array('label' => '保存'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Community\Bundle\GroupBundle\Entity\Member'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'community_bundle_groupbundle_member';
    }
}
