<?php
// src/Acme/FindMartialBundle/Form/Type/RegistrationFormType.php
namespace Acme\FindMartialBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('name', null ,array('label' => 'form.name', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('family', null ,array('label' => 'form.family', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('about', null ,array('label' => 'form.about', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('avatar', null ,array('label' => 'form.avatar', 'translation_domain' => 'FOSUserBundle'));
    }

    public function getName()
    {
        return 'acme_find_martial_registration';
    }
}
