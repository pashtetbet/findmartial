<?php

namespace Acme\FindMartialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('inn')
            ->add('website')
            ->add('mail')
            ->add('phone')
            ->add('status')
            ->add('money')
            ->add('social')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('news_on')
            ->add('is_checked')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('is_checked')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('inn')
            ->add('website')
            ->add('mail')
            ->add('phone')
            ->add('status')
            ->add('money')
            ->add('social')
            ->add('logo')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('news_on')
            ->add('is_checked')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('inn')
            ->add('website')
            ->add('mail')
            ->add('phone')
            ->add('status')
            ->add('money')
            ->add('social')
            ->add('logo')
            ->add('estimate_value')
            ->add('estimate_number')
            ->add('news_on')
            ->add('is_checked')
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
