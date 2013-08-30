<?php
// src/Acme/FindMartialBundle/Admin/MasterAdmin.php

namespace Acme\FindMartialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MasterAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('is_checked', null, array('required' => false))
            ->add('visible', null, array('required' => false))
            //->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('is_checked')
            ->add('visible')
            ->add('family')
            ->add('patronym')
            ->add('hightlights')
            ->add('birth')
            ->add('slave')
            ->add('experience_full')
            ->add('training_exp_full')
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