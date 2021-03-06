<?php
namespace PMS\ProjectBundle\Traits;

trait ProjectTrait
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=150)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(name="short_description", type="string", length=30)
     */
    protected $short_description;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description = '';

    /**
     * @var string $url
     * @ORM\Column(name="url", type="text")
     * @Assert\Url()
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="project")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="project")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="PMS\UserBundle\Entity\Client", inversedBy="project")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * @ORM\OneToMany(targetEntity="PMS\UserBundle\Entity\Developer", mappedBy="project")
     */
    protected $developers;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getShortDescription()
    {
        return $this->short_description;
    }

    public function setShortDescription($description)
    {
        $this->short_description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status = null)
    {
        if ($status instanceof Status) {
            $this->status = $status;
        }

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category = null)
    {
        if ($category instanceof Category) {
            $this->category = $category;
        }

        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client = null)
    {
        if ($client instanceof Client) {
            $this->client = $client;
        }

        return $this;
    }

    public function addDeveloper(PMS\UserBundle\Entity\Developer $developer)
    {
        $this->developers[] = $developer;

        return $this;
    }

    public function getDevelopers()
    {
        return $this->developers;
    }

    public function removeDeveloper(PMS\UserBundle\Entity\Developer $developer)
    {
        $this->developers->removeElement($developer);
    }
}
