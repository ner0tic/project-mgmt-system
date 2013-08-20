<?php
namespace PMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    protected $available_roles = array();

    /**
     * @Route("/", name="homepage")
     * @Template("PMSUserBundle:User:index.html.twig")
     */
    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            $security = $this->get('security.context');

            if ($security->isGranted('ROLE_ADMIN')) {
                return $this->forward('PMSUserBundle:Admin:dashboard');
            } elseif ($security->isGranted('ROLE_DEVELOPER')) {
                return $this->forward('PMSUserBundle:Developer:dashboard');
            } elseif ($security->isGranted('ROLE_CLIENT')) {
                return $this->forward('PMSUserBundle:Client:dashboard');
            }
        }

        $projects = $this->getDoctrine()
                         ->getRepository('PMSProjectBundle:Project')
                         ->getRecent();
        if (!$projects) {
            $projects = array();
        }

        $carousel = array('items' => array());
        foreach ($projects as $project) {
            $carousel['items'][] = array(
                'img' => '/bundles/pmsproject/img/projects/' . $project->getSlug() . '/carousel.png',
                'caption' => $project->getDescription()
            );
        }

        return array('carousel' => $carousel);
    }

    public function registerAction()
    {
        $form = $this->createForm(
            new RegistrationType(),
            new Registration()
        );

        return $this->render(
            'PMSUserBundle:User:register.form.html.twig',
            array(
                'form'  =>  $form->createView()
            )
        );
    }

    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(
            new RegistrationType(),
            new Registration()
        );
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $registration = $form->getData();

            $em->persist($registration->getUser());
            $em->flush();

            $name = '('.$registraion->getLastName().', '.$registraion->getFirstName().')';
            $this->get('session')->getFlashBag()->add(
                'success',
                "user $name created."
            );

            return $this->redirect('PMSUserBundle:User:index');
        }

        return $this->render(
            'PMSUserBundle:User:register.form.html.twig',
            array(
                'form'  =>  $form->createView()
            )
        );
    }
}
