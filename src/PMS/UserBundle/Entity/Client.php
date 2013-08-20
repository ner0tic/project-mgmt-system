<?php
namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\ClientTrait;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 * @UniqueEntity(fields = "username", targetClass = "PMS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "PMS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Client extends User
{
    use ClientTrait;
}
