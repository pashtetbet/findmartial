<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MasterPhotosBlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('masterPhotos', 'collection', array(
                                   'label' => '',
                                   'translation_domain' => 'FindMartialBundle',
                                   'type' => new MasterPhotoType(),
                                   'allow_add' => true,
                                   'allow_delete' => true,
                                   'prototype' => true,
                                   'by_reference' => false,
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
        return 'acme_findmartialbundle_masterphotosblocktype';
    }
}
