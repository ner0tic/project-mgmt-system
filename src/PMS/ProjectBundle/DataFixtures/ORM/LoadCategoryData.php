<?php
namespace PMS\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PMS\ProjectBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $webdev = new Category();
        $webdev->setName('web development');
        $webdev->setDescription('web dev.');
        $webdev->setParent();
        $manager->persist($webdev);
        $this->addReference('category-web-dev', $webdev);

        $symfony = new Category();
        $symfony->setName('symfony');
        $symfony->setDescription('symfony category');
        $symfony->setParent($this->getReference('category-web-dev'));
        $manager->persist($symfony);
        $this->addReference('category-web-dev-symfony', $symfony);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
