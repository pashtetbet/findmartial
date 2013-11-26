<?php

namespace Acme\FindMartialBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler;


class MasterRegistrationFormHandler extends RegistrationFormHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {

            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($user, $confirmation);

                return true;
            }

        }

        return false;
    }

    /*
    методы сохранения связаной с узером сущности в базу

    */

}
