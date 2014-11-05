<?php
#src/Acme/FindMartialBundle/Admin/ClubPhotoAdmin.php
namespace Acme\FindMartialBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
 
class ClubPhotoAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        return $listMapper->addIdentifier('title')->add ('date');
    }
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        return $formMapper->add('title')->add ('date')->add('photo', 'iphp_file');
    }
}