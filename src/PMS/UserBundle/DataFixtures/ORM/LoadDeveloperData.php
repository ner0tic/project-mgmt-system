<?php
namespace Scss\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Scss\UserBundle\Entity\Developer;

class LoadDeveloperData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dev1 = new User();
        $dev1->setUsername('ner0tic');
        $dev1->setPassword('g4t0rade');
        $dev1->setEmail('david.durost@gmail.com');
        $dev1->setFirstName('David');
        $dev1->setLastName('Durost');
        $manager->persist($dev1);
        $this->addReference('dev-david-durost', $dev1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
