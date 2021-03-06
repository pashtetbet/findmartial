<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MasterArtsBlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('masterArt', new MasterArtType(), array('label' => '', 'mapped'=> false))
            ->add('experience_full', null ,array('label' => 'field.experience', 'translation_domain' => 'FindMartialBundle', 'required' => true))
            ->add('training_exp_full', null ,array('label' => 'field.trainingexp', 'translation_domain' => 'FindMartialBundle', 'required' => true))
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
        return 'acme_findmartialbundle_masterartsblocktype';
    }
}
