<?php
namespace PMS\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\ProjectBundle\Entity\Status;

class LoadStatusData extends AbsrtactFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $planning = new Status();
        $planning->setName('planning');
        $manager->persist($planning);
        $this->addReference('status-planning', $planning);

        $active = new Status();
        $active->setName('active');
        $manager->persist($active);
        $this->addReference('status-active', $active);

        $onhold = new Status();
        $onhold->setName('on hold');
        $manager->persist($onhold);
        $this->addReference('status-onhold', $onhold);

        $ongoing = new Status();
        $ongoing->setName('on going');
        $manager->persist($ongoing);
        $this->addReference('status-ongoing', $ongoing);

        $abandoned = new Status();
        $abandoned->setName('abandoned');
        $manager->persist($abandoned);
        $this->addReference('status-abandoned', $abandoned);

        $complete = new Status();
        $complete->setName('complete');
        $manager->persist($complete);
        $this->addReference('status-complete', $complete);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
