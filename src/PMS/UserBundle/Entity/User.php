<?php

namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\UserTrait;
use PMS\UserBundle\Traits\TimestampableTrait;
use FOS\UserBundle\Entity\User as BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"developer" = "Developer", "client" = "Client", "admin" = "Admin"})
 * @UniqueEntity(
 *     fields = "username",
 *     targetClass = "PMS\UserBundle\Entity\User",
 *     message="fos_user.username.already_used"
 * )
 * @UniqueEntity(
 *     fields = "email",
 *     targetClass = "PMS\UserBundle\Entity\User",
 *     message="fos_user.email.already_used"
 * )
 *
 */
abstract class User extends BaseUser
{
    use UserTrait;
    use TimestampableTrait;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
