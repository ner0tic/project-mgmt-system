<?php
namespace PMS\UserBundle\Traits;

trait DeveloperTrait
{
    /**
     * @ORM\OneToMany(targetEntity="PMS\ProjectBundle\Entity\Project", mappedBy="user")
     */
    protected $projects;


}
