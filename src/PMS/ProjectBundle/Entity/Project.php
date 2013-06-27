<?php

namespace PMS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\ProjectBundle\Traits\ProjectTrait;
use PMS\UserBundle\Traits\TimestampableTrait;
use PMS\UserBundle\Traits\SlugableTrait;

/**
 * PMS\ProjectBundle\Entity\Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="PMS\ProjectBundle\Entity\ProjectRepository")
 */
class Project
{
    use ProjectTrait;
    use TimestampableTrait;
    use SlugableTrait;
}
