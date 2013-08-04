<?php
namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\DeveloperTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="developer")
 */
class Developer extends User
{
    use DeveloperTrait;
}
