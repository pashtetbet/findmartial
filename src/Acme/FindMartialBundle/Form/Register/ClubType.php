<?php

namespace Acme\FindMartialBundle\Form\Register;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null ,array('label' => 'club.name', 'translation_domain' => 'FindMartialBundle'))
            ->add('description', null ,array('label' => 'field.description', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('address', null ,array('label' => 'field.address', 'translation_domain' => 'FindMartialBundle'))
            ->add('address_comment', null ,array('label' => 'field.addresscomment', 'translation_domain' => 'FindMartialBundle'))
            ->add('latitude', 'hidden', array('label' => 'field.latitude', 'translation_domain' => 'FindMartialBundle'))
            ->add('longitude', 'hidden',array('label' => 'field.longitude', 'translation_domain' => 'FindMartialBundle'))
            ->add('phone', null ,array('label' => 'field.phone', 'translation_domain' => 'FindMartialBundle'))

            ->add('city', null ,array('label' => 'field.city', 'empty_value' => '...', 'translation_domain' => 'FindMartialBundle', 'required' => true))
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
