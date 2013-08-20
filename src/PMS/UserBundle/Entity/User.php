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
     * @ORM\Id
     * @ORM\Column(type="integer")
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

    protected $slug;

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return PunchKind
     */
    public function setSlug($slug = null)
    {
        if (null == $slug) {
            $this->slug = str_replace(
                ' ',
                '-',
                $this->getFullName()
            );
        }

        return $this;
    }

    public function getName()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
