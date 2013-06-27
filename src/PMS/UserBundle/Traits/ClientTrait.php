<?php
namespace PMS\UserBundle\Traits;

trait ClientTrait
{
    /**
     * @ORM\OneToMany(targetEntity="PMS\ProjectBundle\Entity\Project", mappedBy="user")
     */
    protected $projects;
}
