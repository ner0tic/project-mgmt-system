<?php
    namespace PMS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\ProjectBundle\Entity\Project;
use PMS\ProjectBundle\Form\Type\ProjectType;

class ProjectController extends Controller
{
    /**
     * @Route("/", name="pms_project_index")
     * @Template("PMSProjectBundle:Project:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $projects = $this->get('doctrine')
                          ->getRepository('PMSProjectBundle:Project');

        if (!$projects) {
            $projects = array();
        }

        return array('projects' => $projects);
    }

    /**
     * @Route("/{slug}", name="pms_project_show")
     * @Template("PMSProjectBundle:Project:show.html.twig")
     */
    public function showAction($slug)
    {
        $project = $this->getDoctrine()
                        ->getRepository('PMSProjectBundle:Project')
                        ->findBySlug($slug);

        if (!$project) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching project found.'
            );
            $this->redirect(
                $this->generateUrl('pms_project_index')
            );
        }

        return array(
          'project' => $project
        );
    }

    /**
     * @Route("/new", name="pms_project_new")
     * @Template("PMSProjectBundle:Project:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm(new ProjectType(), $project);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($project);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'project created.'
                );

                return $this->render(
                    'PMSProjectBundle:Project:show.html.twig',
                    array(
                        'project_slug' => $project->getSlug()
                    )
                );
            }
        }

        return array(
          'form' => $form->createView()
        );
    }

    /**
     * @Route("/search/{query}", name="pms_project_search_q")
     * @Route("/search", name="pms_project_search")
     * @Template("PMSProjectBundle:Project:search.html.twig")
     */
    public function searchAction($query = null)
    {
        return array();
    }
}
