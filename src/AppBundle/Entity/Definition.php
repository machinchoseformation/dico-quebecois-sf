<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Definition
 *
 * @ORM\Table()
 * @ORM\HasLifeCycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DefinitionRepository")
 */
class Definition
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

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
     * @var Term
     *
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="definitions")
     */
    private $term;


    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if (!$this->getCreatedDate()){
            $this->setCreatedDate(new \DateTime());
        }
        if (!$this->getModifiedDate()){
            $this->setModifiedDate(new \DateTime());
        }
    }


    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setModifiedDate(new \DateTime());
    }


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
     * Set content
     *
     * @param string $content
     * @return Definition
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Definition
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
     * @return Definition
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
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     * @return Definition
     */
    public function setTerm(\AppBundle\Entity\Term $term = null)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return \AppBundle\Entity\Term 
     */
    public function getTerm()
    {
        return $this->term;
    }

    public function __toString()
    {
        return $this->getContent();
    }
}
