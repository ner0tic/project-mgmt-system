<?php

namespace PMS\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use PMS\ProjectBundle\Traits\CategoryTrait;
use PMS\UserBundle\Traits\TimestampableTrait;
use PMS\UserBundle\Traits\SlugableTrait;

/**
 * PMS\ProjectBundle\Entity\Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="PMS\ProjectBundle\Entity\Repository\CategoryRepository")
 */
class Category
{
    use CategoryTrait;
    use TimestampableTrait;
    use SlugableTrait;
}
