<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MasterArtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('master', null, array('label' => '', 'read_only' => false))
            ->add('art', null ,array('label' => 'БИ'))
            ->add('expirience', null, array('label' => 'опыт личный'))
            ->add('training_exp', null, array('label' => 'опыт тренера'))
            ->add('description', null, array('label' => 'кратко. основные достижения.'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\MasterArt'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_masterarttype';
    }
}
