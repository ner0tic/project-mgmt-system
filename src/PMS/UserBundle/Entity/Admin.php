<?php
namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\AdminTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
  */
class Admin extends User
{
    use AdminTrait;
}
