<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', null ,array('label' => 'field.type', 'translation_domain' => 'FindMartialBundle'))
            ->add('age_low', null ,array('label' => 'field.agelow', 'translation_domain' => 'FindMartialBundle'))
            ->add('age_max', null ,array('label' => 'field.agemax', 'translation_domain' => 'FindMartialBundle'))
            ->add('is_checked', null ,array('label' => 'field.ischecked', 'translation_domain' => 'FindMartialBundle'))
            ->add('visible', null ,array('label' => 'field.visible', 'translation_domain' => 'FindMartialBundle'))
            ->add('price', null ,array('label' => 'field.price', 'translation_domain' => 'FindMartialBundle'))
            ->add('art', null ,array('label' => 'field.art', 'translation_domain' => 'FindMartialBundle'))
    //        ->add('check', null ,array('label' => 'field.check', 'translation_domain' => 'FindMartialBundle'))
            ->add('master', null ,array('label' => 'field.master', 'translation_domain' => 'FindMartialBundle'))
            ->add('club', null ,array('label' => 'field.club', 'translation_domain' => 'FindMartialBundle'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\Training'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_trainingtype';
    }
}
