<?php
namespace PMS\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\ProjectBundle\Entity\Project;

class LoadProjectData extends AbsrtactFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $demo1 = new Project();
        $demo1->setName('project demo 1');
        $demo1->setUrl('http://127.0.0.1');
        $demo1->setStatus($this->getReference('status-planning'));
        $demo1->setCategory($this->getReference('category-demo1'));
        $demo1->setClient($this->getReference('client-testclient1'));
        $manager->persist($demo1);
        $this->addReference('project-demo1', $demo1);
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
