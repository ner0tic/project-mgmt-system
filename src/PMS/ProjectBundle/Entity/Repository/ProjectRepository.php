<?php
namespace PMS\ProjectBundle\Entity\Repository;

use Gedmo\Sortable\Entity\Repository\SortableRepository;

class ProjectRepository extends SortableRepository
{
    public function findAllOrderedByUpdated()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p FROM PMSProjectBundle:Project p ORDER BY p.updated ASC')
                    ->getResult();
    }
}
