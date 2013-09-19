<?php
namespace PMS\UserBundle\Traits;

trait ClientTrait
{
    /**
     * @ORM\OneToMany(targetEntity="PMS\ProjectBundle\Entity\Project", mappedBy="developer")
     */
    protected $projects;

    /**
     * @ORM\Column(name="company", type="string", length=150)
     * @Assert\Null()
     */
    protected $company="";

    /**
     * Set company
     *
     * @param string $company
     * @return Client
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add projects
     *
     * @param \PMS\ProjectBundle\Entity\Project $projects
     * @return Client
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

    public function getHomepage()
    {
        return $this->getUrl();
    }
}
