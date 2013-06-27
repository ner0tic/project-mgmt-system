<?php

namespace PMS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\ProjectBundle\Traits\StatusTrait;
use PMS\UserBundle\Traits\TimestampableTrait;
use PMS\UserBundle\Traits\SlugableTrait;

/**
 * PMS\ProjectBundle\Entity\Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="PMS\ProjectBundle\Entity\StatusRepository")
 */
class Status
{
    use StatusTrait;
    use TimestampableTrait;
    use SlugableTrait;
}
