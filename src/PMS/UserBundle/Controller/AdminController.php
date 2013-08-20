<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @Route("/signup/admin", name="admin_registration")
     */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('PMS\UserBundle\Entity\Admin');
    }

    /**
     * @Template("PMSUserBundle:Admin:dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return array();
    }
}
