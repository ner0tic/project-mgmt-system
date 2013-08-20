<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ClientController extends Controller
{
    /**
     * @Route("/signup/client", name="client_registration")
     */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('PMS\UserBundle\Entity\Client');
    }

    /**
     * @Template("PMSUserBundle:Client:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }

    /**
     * @Route("/{slug}", name="pms_client_show")
     * @Template("PMSUserBundle:Client:show.html.twig")
     */
    public function showAction($slug)
    {
        $client = $this->getDoctrine()
                        ->getRepository('PMSUserBundle:Client')
                        ->findOneBySlug($slug);

        if (!$client) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching client found.'
            );
            $this->redirect(
                $this->generateUrl('pms_client_index')
            );
        }

        return array('client' => $client);
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
