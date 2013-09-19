<?php
namespace PMS\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\UserBundle\Entity\Client;

class LoadClientData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client_self = new Client();
        $client_self->setUsername('ddurost');
        $client_self->setPassword('g4t0rade');
        $client_self->setEmail('david@daviddurost.net');
        $client_self->setFirstName('David');
        $client_self->setLastName('Durost');
        $client_self->setSlug('ddurost');
        $manager->persist($client_self);
        $this->addReference('client-david-durost', $client_self);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
