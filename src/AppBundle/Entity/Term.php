<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Term
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TermRepository")
 */
class Term
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="variations", type="string", length=255)
     */
    private $variations;

    /**
     * @var string
     *
     * @ORM\Column(name="pronunciation", type="string", length=255)
     */
    private $pronunciation;

    /**
     * @var string
     *
     * @ORM\Column(name="nature", type="string", length=50)
     */
    private $nature;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=50)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=50)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="text")
     */
    private $origin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifiedDate", type="datetime")
     */
    private $modifiedDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="votesCount", type="integer")
     */
    private $votesCount;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Definition", mappedBy="term")
     */
    private $definitions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Example", mappedBy="term")
     */
    private $examples;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Term
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set variations
     *
     * @param string $variations
     * @return Term
     */
    public function setVariations($variations)
    {
        $this->variations = $variations;

        return $this;
    }

    /**
     * Get variations
     *
     * @return string 
     */
    public function getVariations()
    {
        return $this->variations;
    }

    /**
     * Set pronunciation
     *
     * @param string $pronunciation
     * @return Term
     */
    public function setPronunciation($pronunciation)
    {
        $this->pronunciation = $pronunciation;

        return $this;
    }

    /**
     * Get pronunciation
     *
     * @return string 
     */
    public function getPronunciation()
    {
        return $this->pronunciation;
    }

    /**
     * Set nature
     *
     * @param string $nature
     * @return Term
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return string 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Term
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Term
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set origin
     *
     * @param string $origin
     * @return Term
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Term
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set modifiedDate
     *
     * @param \DateTime $modifiedDate
     * @return Term
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    /**
     * Get modifiedDate
     *
     * @return \DateTime 
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * Set votesCount
     *
     * @param integer $votesCount
     * @return Term
     */
    public function setVotesCount($votesCount)
    {
        $this->votesCount = $votesCount;

        return $this;
    }

    /**
     * Get votesCount
     *
     * @return integer 
     */
    public function getVotesCount()
    {
        return $this->votesCount;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->definitions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->examples = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add definitions
     *
     * @param \AppBundle\Entity\Definition $definitions
     * @return Term
     */
    public function addDefinition(\AppBundle\Entity\Definition $definitions)
    {
        $this->definitions[] = $definitions;

        return $this;
    }

    /**
     * Remove definitions
     *
     * @param \AppBundle\Entity\Definition $definitions
     */
    public function removeDefinition(\AppBundle\Entity\Definition $definitions)
    {
        $this->definitions->removeElement($definitions);
    }

    /**
     * Get definitions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * Add examples
     *
     * @param \AppBundle\Entity\Example $examples
     * @return Term
     */
    public function addExample(\AppBundle\Entity\Example $examples)
    {
        $this->examples[] = $examples;

        return $this;
    }

    /**
     * Remove examples
     *
     * @param \AppBundle\Entity\Example $examples
     */
    public function removeExample(\AppBundle\Entity\Example $examples)
    {
        $this->examples->removeElement($examples);
    }

    /**
     * Get examples
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExamples()
    {
        return $this->examples;
    }
}
