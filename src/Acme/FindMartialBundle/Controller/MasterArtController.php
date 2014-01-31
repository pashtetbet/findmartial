<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\FindMartialBundle\Entity\Master;
use Acme\FindMartialBundle\Entity\MasterArt;
use Acme\FindMartialBundle\Form\MasterArtType;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

use Xi\Bundle\AjaxBundle\Controller\JsonResponseController;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

use Doctrine\ORM\Query;

use Symfony\Component\Debug\Debug;

/**
 * MasterArt controller.
 *
 * @Route("/masterart")
 */
class MasterArtController extends JsonResponseController
{

    /** create edit action
     *
     * @Route("/", name="masterart_put")
     * @Method("PUT")
     */
    public function putAction(Request $request)
    {
            Debug::enable();

        $masterartRequest = $request->request->get('acme_findmartialbundle_masterarttype');
        $masterId = $masterartRequest['master'];
        $artId = $masterartRequest['art'];

        $em = $this->getDoctrine()->getManager();
        $masterEntity = $em->getRepository('AcmeFindMartialBundle:Master')->find($masterId);


        // check for edit access
        $securityContext = $this->get('security.context');
        if (false === $securityContext->isGranted('EDIT', $masterEntity)) {
            throw new AccessDeniedException();
        }

        $masterArtEntity = $em->getRepository('AcmeFindMartialBundle:MasterArt')->find(array(
            'master'    => $masterId, 
            'art'       => $artId
        ));

        if (!$masterArtEntity) {
            $masterArtEntity = new MasterArt($masterId, $artId);
        }

        $formArt        = $this->createForm(new MasterArtType(), $masterArtEntity);

        $formArt->bind($request);

        if ($formArt->isValid()) {
 
            $em->persist($masterArtEntity);
            $em->flush();


            //вернем список исккуств для мастера
            $encoders = array(new JsonEncoder());
            $normalizers = array(new GetSetMethodNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $masterArts = $em->getRepository('AcmeFindMartialBundle:MasterArt')->findByMaster($masterId);

            $normArray = array();
            foreach($masterArts as $masterArt){
                $normArray[] = array(
                    'art' => $masterArt->getArt()->getName(),
                    'training_exp'  => $masterArt->getTrainingExp(),
                    'expirience'    => $masterArt->getExpirience(),
                    'description'   => $masterArt->getDescription(),
                );
            }

            $masterArtsReport = $serializer->serialize($normArray, 'json');

            return $this->createJsonSuccessWithContent(
                    $masterArtsReport,
                    'callbackMasterArtSave'
            );

        }



        $this->createJsonFailureResponse('something went wrong...');

    }

    /**
     * Deletes a Master entity.
     *
     * @Route("/{id}", name="masterart_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $masterId, $artId)
    {

        $securityContext = $this->get('security.context');
        
        $form = $this->createDeleteForm($masterId, $artId);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find(array(
                'master' => $masterId, 
                'art' => $artId
            ));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Master entity.');
            }

            if (false === $securityContext->isGranted('DELETE', $entity)) {
                throw new AccessDeniedException();
            }

            $em->remove($entity);
            $em->flush();

            return $this->createJsonSuccessWithContent(
                    'artsList',
                    'enableArtsForm'
            );
        }

        $this->createJsonFailureResponse('something went wrong...');
    }

    /**
     * Creates a form to delete a MasterArt entity by ids.
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($masterId, $artId)
    {
        return $this->createFormBuilder(array('masterId' => $masterId, 'artId' => $artId))
            ->add('masterId', 'hidden')
            ->add('artId', 'hidden')
            ->getForm()
        ;
    }
}
