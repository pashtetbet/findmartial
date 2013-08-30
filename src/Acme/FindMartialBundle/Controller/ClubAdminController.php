<?php

namespace Acme\FindMartialBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class ClubAdminController extends CRUDController
{
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
