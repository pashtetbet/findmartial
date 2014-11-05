<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MasterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null ,array('label' => 'field.name', 'translation_domain' => 'FindMartialBundle', 'required' => true))
            ->add('family', null ,array('label' => 'field.family', 'translation_domain' => 'FindMartialBundle', 'required' => true))
            ->add('patronym', null ,array('label' => 'field.patronym', 'translation_domain' => 'FindMartialBundle'))
            ->add('hightlights', null ,array('label' => 'field.hightlights', 'translation_domain' => 'FindMartialBundle'))
            ->add('description', 'textarea' ,array('label' => 'field.description', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('sex', 'choice' ,
                                                array(
                                                  'label' => 'field.sex', 
                                                  'translation_domain' => 'FindMartialBundle', 
                                                  'choices'   => array('male' => 'club.sex.male', 'female' => 'club.sex.female'), 
                                                  'empty_value' => '...', 
                                                  'required' => true
                                                ))
            ->add('slave', null ,array('label' => 'field.slave', 'translation_domain' => 'FindMartialBundle', 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\Master'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_mastertype';
    }
}
