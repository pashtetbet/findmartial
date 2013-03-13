<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }
}
