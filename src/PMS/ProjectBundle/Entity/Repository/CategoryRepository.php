<?php
namespace PMS\ProjectBundle\Entity\Repository;

use Gedmo\Sortable\Entity\Repository\SortableRepository;

class CategoryRepository extends SortableRepository
{
    public function findAllOrderedByUpdated()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT c FROM PMSProjectBundle:Category c ORDER BY c.updated ASC')
                    ->getResult();
    }
}
