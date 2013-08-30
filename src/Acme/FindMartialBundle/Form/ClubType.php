<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', null ,array('label' => 'field.description', 'translation_domain' => 'FindMartialBundle'))
            ->add('address', null ,array('label' => 'field.address', 'translation_domain' => 'FindMartialBundle'))
            ->add('address_comment', null ,array('label' => 'field.addresscomment', 'translation_domain' => 'FindMartialBundle'))
            ->add('latitude', 'hidden', array('label' => 'field.latitude', 'translation_domain' => 'FindMartialBundle'))
            ->add('longitude', 'hidden',array('label' => 'field.longitude', 'translation_domain' => 'FindMartialBundle'))
            ->add('mail', null ,array('label' => 'field.mail', 'translation_domain' => 'FindMartialBundle'))
            ->add('phone', null ,array('label' => 'field.phone', 'translation_domain' => 'FindMartialBundle'))
            ->add('indic_price_min', null ,array('label' => 'field.indicpricemin', 'translation_domain' => 'FindMartialBundle'))
            ->add('indic_price_max', null ,array('label' => 'field.indicpricemax', 'translation_domain' => 'FindMartialBundle'))
            ->add('age_type', null ,array('label' => 'field.agetype', 'translation_domain' => 'FindMartialBundle'))
            ->add('sex', null ,array('label' => 'field.sex', 'translation_domain' => 'FindMartialBundle'))
            ->add('one_training_free', null ,array('label' => 'field.onetrainingfree', 'translation_domain' => 'FindMartialBundle'))
            //->add('photo', 'iphp_file' ,array('label' => 'field.photo', 'translation_domain' => 'FindMartialBundle'))
            ->add('clubPhotos', 'collection', array(
                                   'label' => '',
                                   'translation_domain' => 'FindMartialBundle',
                                   'type' => new ClubPhotoType(),
                                   'allow_add' => true,
                                   'allow_delete' => true,
                                   'prototype' => true,
                                   'by_reference' => false,
                                  ))
            ->add('visible', null ,array('label' => 'field.visible', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('city', null ,array('label' => 'field.city', 'empty_value' => 'field.citylabel', 'translation_domain' => 'FindMartialBundle', 'required' => true))
            ->add('servises', null ,array('label' => 'field.servises', 'expanded' => true, 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('masters', 'entity' ,array('class' => 'AcmeFindMartialBundle:Master', 'expanded' => true, 'multiple' => true, 'label' => 'field.masters', 'translation_domain' => 'FindMartialBundle', 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\Club'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_clubtype';
    }
}
