<?php
    namespace PMS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\ProjectBundle\Entity\Status;
use PMS\ProjectBundle\Form\Type\StatusType;

/**
 * @Menu(translateDomain="MillwrightMenuBundle")
 * @Route("/statuses")
 */
class StatusController extends Controller
{
    /**
     * @Route("/", name="pms_status_index")
     * @Template("PMS\ProjectBundle:Status:index.html.twig")
     * @Menu(label="statuses")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $statuses = $this->get('doctrine')
                          ->getRepository('PMSProjectBundle:Status');

        if (!$statuses) {
            $statuses = array();
        }

        return array('statuses' => $statuses);
    }

    /**
     * @Route("/{slug}", name="pms_status_show")
     * @Template("PMS\ProjectBundle:Status:show.html.twig")
     */
    public function showAction($slug)
    {
        $status = $this->getDoctrine()
                       ->getRepository('PMSProjectBundle:Status')
                       ->findBySlug($slug);

        if (!$status) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching status found.'
            );
            $this->redirect(
                $this->generateUrl('pms_status_index')
            );
        }

        return array('status' => $status);
    }

    /**
     * @Route("/statuses/new", name="pms_status_new")
     * @Template("PMS\ProjectBundle:Status:new.html.twig")
     * @Menu(label="add a status")
     * @Secure(roles="ROLE_ADMIN")
     * @SecureParam(name="category", permission="EDIT")
     */
    public function newAction(Request $request)
    {
        $status = new Status();
        $form = $this->createForm(new StatusType(), $status);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($status);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'status created.'
                );

                return $this->render(
                    'PMSProjectBundle:Status:show.html.twig',
                    array('status_slug' => $status->getSlug())
                );
            }
        }

        return array(
          'form' => $form->createView()
        );
    }
}
