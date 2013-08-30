<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null ,array('label' => 'field.description', 'translation_domain' => 'FindMartialBundle'))
            ->add('photo', 'iphp_file' ,array('label' => 'field.photo', 'translation_domain' => 'FindMartialBundle'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\ClubPhoto'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_clubphototype';
    }
}
