<?php
namespace PMS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\UserBundle\Traits\ClientTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client extends User
{
    use ClientTrait;
}
