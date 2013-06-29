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
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable="true")
     */
    protected $description;

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
}
