<?php
// src/Acme/FindMartialBundle/Form/Type/RegistrationFormType.php
namespace Acme\FindMartialBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Acme\FindMartialBundle\Form\ClubType as ClubType;

class RegistrerClubType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('name', null ,array('label' => 'form.name', 'translation_domain' => 'FOSUserBundle', 'required' => false));
        //$builder->add('family', null ,array('label' => 'form.family', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('about', null ,array('label' => 'form.about', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('avatar', 'iphp_file' ,array('label' => 'form.avatar', 'translation_domain' => 'FOSUserBundle', 'required' => false));
        //$builder->add('roles' ,'choice' ,array('multiple' => 'true', 'choices'=>array('ROLE_USER' => 'пользователь', 'ROLE_CLIENT' => 'клиент', 'ROLE_MASTER' => 'мастер')));
        $builder->add('club', new ClubType());
    }

    public function getName()
    {
        return 'acme_find_martial_club_registration';
    }
}
