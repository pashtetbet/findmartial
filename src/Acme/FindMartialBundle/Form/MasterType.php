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
            ->add('name', null ,array('label' => 'field.name', 'translation_domain' => 'FindMartialBundle'))
            ->add('family', null ,array('label' => 'field.family', 'translation_domain' => 'FindMartialBundle'))
            ->add('patronym', null ,array('label' => 'field.patronym', 'translation_domain' => 'FindMartialBundle'))
            ->add('hightlights', null ,array('label' => 'field.hightlights', 'translation_domain' => 'FindMartialBundle'))
            ->add('description', null ,array('label' => 'field.description', 'translation_domain' => 'FindMartialBundle'))
            ->add('sex', null ,array('label' => 'field.sex', 'translation_domain' => 'FindMartialBundle'))
            ->add('photo', null ,array('label' => 'field.photo', 'translation_domain' => 'FindMartialBundle'))
            ->add('slave', null ,array('label' => 'field.slave', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('visible', null ,array('label' => 'field.visible', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('experience_full', null ,array('label' => 'field.experience', 'translation_domain' => 'FindMartialBundle'))
            ->add('training_exp_full', null ,array('label' => 'field.trainingexp', 'translation_domain' => 'FindMartialBundle'))
            ->add('masterArts', 'collection', array(
                                               'label' => 'field.arts',
                                               'translation_domain' => 'FindMartialBundle',
                                               'type' => new MasterArtType(),
                                               'allow_add' => true,
                                               'allow_delete' => true,
                                               'prototype' => true,
                                               'by_reference' => false,
                                              ))
            ->add('arts', 'entity', array(
                                               'class' => 'AcmeFindMartialBundle:Art',
                                               'expanded' => true,
                                               'multiple' => true,
                                               'label' => 'Боевые искусства',
                                               'mapped' => false,
                                              ))
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
