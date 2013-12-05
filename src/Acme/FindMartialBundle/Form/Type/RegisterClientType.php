<?php
// src/Acme/FindMartialBundle/Form/Type/RegistrationFormType.php
namespace Acme\FindMartialBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Acme\FindMartialBundle\Form\Register\ClientType as ClientType;

class RegisterClientType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('client', new ClientType(), array('label' => ''));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FindMartialBundle\Entity\User'
        ));
    }
    
    public function getName()
    {
        return 'acme_find_martial_client_registration';
    }
}
