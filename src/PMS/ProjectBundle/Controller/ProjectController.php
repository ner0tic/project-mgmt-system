<?php
    namespace PMS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\ProjectBundle\Entity\Project;
use PMS\ProjectBundle\Form\Type\ProjectType;

/**
 * @Menu(translateDomain="MillwrightMenuBundle")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/", name="pms_projects_index")
     * @Template("PMS\ProjectBundle:Project:index.html.twig")
     * @Menu(label="projects")
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
     * @Template("PMS\ProjectBundle:Project:show.html.twig")
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
     * @Template("PMS\ProjectBundle:Project:new.html.twig")
     * @Secure(roles="ROLE_DEVELOPER_ADMIN")
     * @SecureParam(name="project", permissions="EDIT")
     * @Menu(label="add a project")
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
}
