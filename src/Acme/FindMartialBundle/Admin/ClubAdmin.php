<?php

namespace Acme\FindMartialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClubAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('description')
            ->add('address')
            ->add('address_comment')
            ->add('latitude')
            ->add('longitude')
            ->add('mail')
            ->add('phone')
            ->add('indic_price_min')
            ->add('indic_price_max')
            ->add('age_type')
            ->add('sex')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('one_training_free')
            ->add('is_checked')
            ->add('visible')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('description')
            ->add('is_checked')
            ->add('visible')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('description')
            ->add('address')
            ->add('address_comment')
            ->add('latitude')
            ->add('longitude')
            ->add('mail')
            ->add('phone')
            ->add('indic_price_min')
            ->add('indic_price_max')
            ->add('age_type')
            ->add('sex')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('one_training_free')
            //->add('photo')
            ->add('is_checked')
            ->add('visible')
            ->add('city', null ,array('label' => 'field.city', 'empty_value' => 'field.citylabel', 'translation_domain' => 'FindMartialBundle', 'required' => true))
            ->add('servises', null ,array('label' => 'field.servises', 'expanded' => true, 'translation_domain' => 'FindMartialBundle', 'required' => false))
            ->add('masters', 'entity' ,array('class' => 'AcmeFindMartialBundle:Master', 'multiple' => true, 'label' => 'field.masters', 'translation_domain' => 'FindMartialBundle', 'required' => false))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('description')
            ->add('address')
            ->add('address_comment')
            ->add('latitude')
            ->add('longitude')
            ->add('mail')
            ->add('phone')
            ->add('indic_price_min')
            ->add('indic_price_max')
            ->add('age_type')
            ->add('sex')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('one_training_free')
            //->add('photo')
            ->add('is_checked')
            ->add('visible')
        ;
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        //$actions = parent::getBatchActions();


            $actions['check']= array('label' => $this->trans('action_check', array(), 'SonataAdminBundle'),
                'ask_confirmation' => true);
            $actions['visible']= array('label' => $this->trans('action_visible', array(), 'SonataAdminBundle'),
                'ask_confirmation' => true);

        return $actions;
    }
}
