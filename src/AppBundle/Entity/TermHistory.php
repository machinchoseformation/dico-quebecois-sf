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
class TermHistory extends AbstractTerm
{
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
