<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WordOfTheDay contains a relation to a Term, and the date on which this word will be displayed.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WordOfTheDayRepository")
 */
class WordOfTheDay
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \Term
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Term")
     */
    private $term;

    /**
     * @param Term $term
     */
    public function __construct(Term $term = null)
    {
        $this->term = $term;
        $this->date = new \DateTime();
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
     * Set date
     *
     * @param \DateTime $date
     * @return WordOfTheDay
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set term
     *
     * @param \AppBundle\Entity\Term $term
     * @return WordOfTheDay
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
