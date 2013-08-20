<?php
namespace PMS\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\ProjectBundle\Entity\Status;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $planning = new Status();
        $planning->setName('planning');
        $planning->setDescription('project is in planning stages.');
        $manager->persist($planning);
        $this->addReference('status-planning', $planning);

        $active = new Status();
        $active->setName('active');
        $active->setDescription('project is in active development.');
        $manager->persist($active);
        $this->addReference('status-active', $active);

        $onhold = new Status();
        $onhold->setName('on hold');
        $onhold->setDescription('project is on hold.');
        $manager->persist($onhold);
        $this->addReference('status-onhold', $onhold);

        $ongoing = new Status();
        $ongoing->setName('on going');
        $ongoing->setDescription('project is an ongoing (maintainence) project.');
        $manager->persist($ongoing);
        $this->addReference('status-ongoing', $ongoing);

        $abandoned = new Status();
        $abandoned->setName('abandoned');
        $abandoned->setDescription('project has been abandoned.');
        $manager->persist($abandoned);
        $this->addReference('status-abandoned', $abandoned);

        $complete = new Status();
        $complete->setName('complete');
        $complete->setDescription('project has been completed.');
        $manager->persist($complete);
        $this->addReference('status-complete', $complete);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
