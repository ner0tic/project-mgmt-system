<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DeveloperController extends Controller
{
    /**
     * @Route("/signup/developer", name="developer_registration")
     */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('PMS\UserBundle\Entity\Developer');
    }

    /**
     * @Template("PMSUserBundle:Developer:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }

    /**
     * @Route("/{slug}", name="pms_developer_show")
     * @Template("PMSUserBundle:Developer:show.html.twig")
     */
    public function showAction($slug)
    {
        $developer = $this->getDoctrine()
                        ->getRepository('PMSUserBundle:Developer')
                        ->findOneBySlug($slug);

        if (!$developer) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching developer found.'
            );
            $this->redirect(
                $this->generateUrl('pms_developer_index')
            );
        }

        return array('developer' => $developer);
    }

    /**
     * @Route("/developers", name="pms_developer_index")
     * @Template("PMSUserBundle:Developer:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
