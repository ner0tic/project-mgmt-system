<?php
namespace PMS\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware
{
    private $factory;

    private $securityContext;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function projectMenu()
    {
        $menu = $this->factory->createItem(
            'projects',
            array(
                'route' => 'pms_project_index',
                'attributes' => array('dropdown' => true)
            )
        );

        $menu->addChild('find a project', array('route' => 'pms_project_search'));

        if ($this->securityContext->isGranted('ROLE_DEVELOPER_ADMIN')) {
            $menu->addChild('add a project', array('route' => 'pms_project_new'));
        }

        if ($this->securityContext->isGranted('ROLE_DEVELOPER')) {
            $menu->addChild('active', array('route' => 'pms_developer_active_projects'));

            $menu->addChild('archives', array('route' => 'pms_projects_by_developer'));
        }

        $menu->addChild($this->categoryMenu());

        $menu->addChild($this->statusMenu());

        return $menu;
    }

    public function categoryMenu()
    {
        $menu = $this->factory->createItem(
            'categories',
            array(
                'route' => 'pms_category_index',
                'label' => 'project categories'
            )
        );

        if ($this->securityContext->isGranted('ROLE_DEVELOPER_ADMIN')) {
            $menu->addChild('add a category', array('route' => 'pms_category_new'));
        }

        return $menu;
    }

    public function statusMenu()
    {
        $menu = $this->factory->createItem(
            'statuses',
            array(
                'route' => 'pms_status_index',
                'label' => 'project statuses'
            )
        );

        if ($this->securityContext->isGranted('ROLE_ADMIN')) {
            $menu->addChild('add a status', array('route' => 'pms_status_new'));
        }

        return $menu;
    }

    public function clientMenu()
    {
        $menu = $this->factory->createItem(
            'clients',
            array('route' => 'pms_client_index')
        );

        if ($this->securityContext->isGranted('ROLE_ADMIN')) {
            $menu->addChild('add a client', array('route' => 'pms_client_new'));
        }

        return $menu;
    }

    public function developerMenu()
    {
        $menu = $this->factory->createItem(
            'developers',
            array('route' => 'pms_developer_index')
        );

        if ($this->securityContext->isGranted('ROLE_DEVELOPER_ADMIN')) {
            $menu->addChild('promote a developer', array('route' => 'pms_developer_promote'));

            $menu->addChild('add a developer', array('route' => 'pms_developer_new'));
        }

        return $menu;
    }

    public function profileMenu()
    {
        $menu = $this->factory->createItem(
            $this->securityContext->getToken()->getUser(),
            array(
                'route' => 'fos_user_profile_edit',
                'attributes' => array(
                    'class' => 'pull-right',
                    'dropdown' => true,
                    'divider_append' => true,
                )
            )
        );

        $menu->addChild('view profile', array('route' => 'fos_user_profile_show'));

        $menu->addChild('change password', array('route' => 'fos_user_change_password'));

        $menu->addChild('add a developer', array('route' => 'fos_user_security_logout'));

        return $menu;
    }

    public function createMainMenu(Request $request, ContainerInterface $container)
    {
        $this->securityContext = $container->get('security.context');

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        // $menu->addChild('home', array('route' => 'homepage'));

        $menu->addChild($this->projectMenu());

        if (!$this->securityContext->isGranted('ROLE_CLIENT')) {
            $menu->addChild($this->clientMenu());
        }

        $menu->addChild($this->developerMenu());

        if ($this->securityContext->isGranted('ROLE_USER')) {
            $menu->addChild($this->profileMenu());
        } else {
            $menu->addChild('sign up', array('route' => 'fos_user_registration_register'));
            $menu->addChild('sign in', array('route' => 'fos_user_security_login'));
        }

        return $menu;
    }
}
