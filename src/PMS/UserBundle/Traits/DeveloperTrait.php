<?php
namespace PMS\UserBundle\Traits;

trait DeveloperTrait
{
    /**
     * @ORM\OneToMany(targetEntity="PMS\ProjectBundle\Entity\Project", mappedBy="developer")
     */
    protected $projects;

    /**
     * Add projects
     *
     * @param \PMS\ProjectBundle\Entity\Project $projects
     * @return Developer
     */
    public function addProject(\PMS\ProjectBundle\Entity\Project $projects)
    {
        $this->projects[] = $projects;

        return $this;
    }

    /**
     * Remove projects
     *
     * @param \PMS\ProjectBundle\Entity\Project $projects
     */
    public function removeProject(\PMS\ProjectBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    public function getPortfolio()
    {
        return $this->getUrl();
    }
}
