<?php
// Acme/FindMartial/Controller/MasterAdminController.php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MasterAdminController extends CRUDController
{
	/*public function batchActionCheckIsRelevant(array $normalizedSelectedIds, $allEntitiesSelected)
	{
	    // here you have access to all POST parameters, if you use some custom ones
	    // POST parameters are kept even after the confirmation page.
	    $parameterBag = $this->get('request')->request;

	    // check that a target has been chosen
	    if (!$parameterBag->has('targetId')) {
	        return 'flash_batch_merge_no_target';
	    }

	    $normalizedTargetId = $parameterBag->get('targetId');

	    // if all entities are selected, a merge can be done
	    if ($allEntitiesSelected) {
	        return true;
	    }

	    // filter out the target from the selected models
	    $normalizedSelectedIds = array_filter($normalizedSelectedIds,
	        function($normalizedSelectedId) use($normalizedTargetId){
	            return $normalizedSelectedId !== $normalizedTargetId;
	        }
	    );

	    // if at least one but not the target model is selected, a merge can be done.
	    return count($normalizedSelectedIds) > 0;
	}*/


	public function batchActionCheck(ProxyQueryInterface $selectedModelQuery)
	{
	    if ($this->admin->isGranted('EDIT') === false)
	    {
	        throw new AccessDeniedException();
	    }

	    $modelManager = $this->admin->getModelManager();

	    $selectedModels = $selectedModelQuery->execute();

	    // do the merge work here

	    try {
	        foreach ($selectedModels as $selectedModel) {
	        	$selectedModel->setIsChecked(true);
	            $modelManager->update($selectedModel);
	        }
	    } catch (\Exception $e) {
	        $this->get('session')->setFlash('sonata_flash_error', 'flash_batch_check_error');

	        return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
	    }

	    $this->get('session')->setFlash('sonata_flash_success', 'flash_batch_check_success');

	    return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
	}


}