<?php
    namespace PMS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use PMS\ProjectBundle\Entity\Category;
use PMS\ProjectBundle\Form\Type\CategoryType;

/**
 * @Route("/categories")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/categories", name="pms_category_index")
<<<<<<< HEAD
     * @Template("PMSProjectBundle:Category:index.html.twig")
=======
     * @Template("PMS\ProjectBundle:Category:index.html.twig")
>>>>>>> 63db47beb7bff9f97294f89c4311eb3094f06fc9
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $categories = $this->get('doctrine')
                          ->getRepository('PMSProjectBundle:Category');

        if (!$categories) {
            $categories = array();
        }

        return array('categories' => $categories);
    }

    /**
     * @Route("/{slug}", name="pms_category_show")
     * @Template("PMSProjectBundle:Category:show.html.twig")
     */
    public function showAction($slug)
    {
        $category = $this->getDoctrine()
                       ->getRepository('PMSProjectBundle:Category')
                       ->findBySlug($slug);

        if (!$category) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching category found.'
            );
            $this->redirect(
                $this->generateUrl('pms_category_index')
            );
        }

        return array('category' => $category);
    }

    /**
     * @Route("/categories/new", name="pms_category_new")
<<<<<<< HEAD
     * @Template("PMSProjectBundle:Category:new.html.twig")
=======
     * @Template("PMS\ProjectBundle:Category:new.html.twig")
>>>>>>> 63db47beb7bff9f97294f89c4311eb3094f06fc9
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'category created.'
                );

                return $this->render(
                    'PMSProjectBundle:Category:show.html.twig',
                    array('category_slug' => $category->getSlug())
                );
            }
        }

        return array(
          'form' => $form->createView()
        );
    }
}
