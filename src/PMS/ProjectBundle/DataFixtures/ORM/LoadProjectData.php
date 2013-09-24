<?php
namespace PMS\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\ProjectBundle\Entity\Project;

class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $ddnet = new Project();
        $ddnet->setName('daviddurost.net');
        $ddnet->setUrl('http://daviddurost.net');
        $ddnet->setShortDescription('portfolio site.');
        $ddnet->setStatus($this->getReference('status-complete'));
        $ddnet->setCategory($this->getReference('category-web-dev'));
        $ddnet->setClient($this->getReference('client-david-durost'));
        $ddnet->setDescription('project portfolio site.');
        $manager->persist($ddnet);
        $this->addReference('project-ddnet', $ddnet);

        $ridesocial = new Project();
        $ridesocial->setName('ridesocial');
        $ridesocial->setUrl('http://daviddurost.net/projects/ridesocial');
        $ridesocial->setShortDescription('social ride sharing network.');
        $ridesocial->setStatus($this->getReference('status-active'));
        $ridesocial->setCategory($this->getReference('category-web-dev-symfony'));
        $ridesocial->setClient($this->getReference('client-david-durost'));
        $ridesocial->setDescription('social ride sharing network.');
        $manager->persist($ridesocial);
        $this->addReference('project-ridesocial', $ridesocial);

        $scss = new Project();
        $scss->setName('summer camp scheduling system');
        $scss->setUrl('http://daviddurost.net/projects/summer-camp-scheduling-system');
        $scss->setShortDescription('course management system.');
        $scss->setStatus($this->getReference('status-active'));
        $scss->setCategory($this->getReference('category-web-dev-symfony'));
        $scss->setClient($this->getReference('client-david-durost'));
        $scss->setDescription('multi-portaled course management system.');
        $manager->persist($scss);
        $this->addReference('project-scss', $scss);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
