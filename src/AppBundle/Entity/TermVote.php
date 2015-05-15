<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Term;

/**
 * TermVote, stored mainly to avoid duplicates votes on same term
 *
 * @ORM\Table()
 * @ORM\HasLifeCycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TermVoteRepository")
 */
class TermVote
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
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var Term
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Term", inversedBy="votes")
     */
    private $term;


    public function __construct($ip, Term $term)
    {
        $this->setIp($ip);
        $this->setTerm($term);
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setDateCreated(new \DateTime());
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
     * Set ip
     *
     * @param string $ip
     * @return TermVote
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return TermVote
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     * @return TermVote
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
}
