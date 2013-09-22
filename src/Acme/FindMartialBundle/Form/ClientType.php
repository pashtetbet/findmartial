<?php

namespace Acme\FindMartialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null ,array('label' => 'client.name', 'translation_domain' => 'FindMartialBundle'))
            ->add('inn', null ,array('label' => 'field.inn', 'translation_domain' => 'FindMartialBundle'))
            ->add('website', null ,array('label' => 'field.website', 'translation_domain' => 'FindMartialBundle'))
            ->add('mail', null ,array('label' => 'field.mail', 'translation_domain' => 'FindMartialBundle'))
            ->add('phone', null ,array('label' => 'field.phone', 'translation_domain' => 'FindMartialBundle'))
            //->add('status', null ,array('label' => 'field.status', 'translation_domain' => 'FindMartialBundle'))
            //->add('money', null ,array('label' => 'field.money', 'translation_domain' => 'FindMartialBundle'))
            ->add('social', 'choice',
                                array('label' => 'field.social', 
                                    'translation_domain' => 'FindMartialBundle',
                                    'choices'   => array('social' => 'social', 'municipal' => 'municipal'), 
                                    'empty_value' => '...', 
                                    'required' => false
                                ))
            ->add('logo', 'iphp_file' ,array('label' => 'field.logo', 'translation_domain' => 'FindMartialBundle', 'required' => false))
            //->add('news_on', null ,array('label' => 'field.newson', 'translation_domain' => 'FindMartialBundle', 'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\Client'
        ));
    }

    public function getName()
    {
        return 'acme_findmartialbundle_clienttype';
    }
}
