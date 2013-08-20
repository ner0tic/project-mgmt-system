<?php
namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\DeveloperTrait;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="developer")
 * @UniqueEntity(fields = "username", targetClass = "PMS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "PMS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Developer extends User
{
    use DeveloperTrait;
}
