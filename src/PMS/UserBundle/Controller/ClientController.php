<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\UserBundle\Entity\Client;
use PMS\UserBundle\Form\Type\ClientFormType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

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
     * @Route("/clients/{slug}", name="pms_client_show")
     * @Template("PMSUserBundle:Client:show.html.twig")
     */
    public function showAction($slug)
    {
        $client = $this->getDoctrine()
                        ->getRepository('PMSUserBundle:User')
                        ->findOneBySlug($slug)
                        ->andWhere('type = client');

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

        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
                          ->getRepository('PMSUserBundle:Client')
                          ->createQueryBuilder('c')
                          ->orderBy('c.last_name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'clients' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }
}
