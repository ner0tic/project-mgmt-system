<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClientController extends Controller
{
    /**
     * @Route("/signup/client", name="client_registration")
     * @Template("PMSUserBundle:Client:register.html.twig")
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
     * @Template("PMSUserBundle:Client:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }

    /**
     * @Route("/clients", name="pms_client_index")
     * @Template("PMSUserBundle:Client:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
