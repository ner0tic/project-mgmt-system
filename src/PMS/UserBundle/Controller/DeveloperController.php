<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\UserBundle\Entity\Developer;
use PMS\UserBundle\Form\Type\DeveloperFormType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

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
     * @Route("/developers/{slug}/projects", name="pms_developer_project_index")
     * @Template("PMSProjectBundle:Project:index.html.twig")
     */
    public function projectsAction($slug)
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

        $pager = new PagerFanta(new DoctrineCollectionAdapter($developer->getProjects()));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'projects' => $pager->getCurrentPageResults(),
            'pager' =>  $pager
        );
    }

    /**
     * @Route("/developers/{slug}", name="pms_developer_show")
     * @Template("PMSUserBundle:Developer:show.html.twig")
     */
    public function showAction($slug)
    {
        $developer = $this->getDoctrine()
                        ->getRepository('PMSUserBundle:User')
                        ->findOneBySlug($slug)
                        ->andWhere('type = developer');

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

        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
                          ->getRepository('PMSUserBundle:Developer')
                          ->createQueryBuilder('d')
                          ->orderBy('d.last_name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'developers' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }
}
