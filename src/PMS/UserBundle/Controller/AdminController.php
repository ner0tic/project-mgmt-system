<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @Route("/signup/admin", name="admin_registration")
     * @Template("PMSUserBundle:Admin:register.html.twig")
     */
    public function registerAction()
    {
        $handler = $this->container->get('pugx_multi_user.controller.handler');
        $discriminator = $this->container->get('pugx_user_discriminator');

        $return = $handler->registration('PMS\UserBundle\Entity\Admin');
        $form = $discriminator->getRegistrationForm();

        if ($return instanceof RedirectResponse) {
            return $return;
        }

        /** @todo fix this! */
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
        }

        return array('form' => $form->createView());
    }

    /**
     * @Template("PMS\UserBundle:Admin:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }
}
