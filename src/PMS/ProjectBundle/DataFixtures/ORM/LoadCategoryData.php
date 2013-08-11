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
        $category1 = new Category();
        $category1->setName('category demo 1');
        $manager->persist($category1);
        $this->addReference('category-demo1', $category1);

        $category2 = new Category();
        $category2->setName('category demo 2');
        $category2->setDescription('blah blah blah');
        $category2->setParent($this->getReference($category1));
        $manager->persist($category2);
        $this->addReference('category-demo2', $category2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
