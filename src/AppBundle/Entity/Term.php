<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use AppBundle\Entity\TermHistory;

/**
 * Term
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TermRepository")
 */
class Term extends AbstractTerm
{

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Definition", mappedBy="term", cascade={"persist", "remove"})
     */
    private $definitions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Example", mappedBy="term", cascade={"persist", "remove"})
     */
    private $examples;

    /**
     * @var Category
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="terms")
     */
    private $category;

    /**
     * @Assert\Callback()
     */
    public function validateDefinitions(ExecutionContextInterface $context)
    {
        //remove empty definitions first
        foreach($this->getDefinitions() as $def){
            if ($def->getContent() == ""){
                $this->removeDefinition($def);
            }
        }

        if (count($this->getDefinitions()) < 1){
            $context->buildViolation('Veuillez ajouter au moins une définition !')
                ->atPath('definitions')
                ->addViolation();
        }
    }


    /**
     * @Assert\Callback()
     */
    public function validateExamples(ExecutionContextInterface $context)
    {
        //remove empty examples first
        foreach($this->getExamples() as $ex){
            if ($ex->getContent() == ""){
                $this->removeExample($ex);
            }
        }

        foreach($this->getExamples() as $ex){
            if ($ex->getTranslation() == ""){
                $context->buildViolation('Veuillez traduire vos exemples !')
                    ->atPath('examples')
                    ->addViolation();
            }
        }
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
     * Add definition
     *
     * @param \AppBundle\Entity\Definition $definition
     * @return Term
     */
    public function addDefinition(\AppBundle\Entity\Definition $definition)
    {
        $this->definitions[] = $definition;
        $definition->setTerm($this);

        return $this;
    }

    /**
     * Remove definition
     *
     * @param \AppBundle\Entity\Definition $definition
     */
    public function removeDefinition(\AppBundle\Entity\Definition $definition)
    {
        $this->definitions->removeElement($definition);
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
     * Add example
     *
     * @param \AppBundle\Entity\Example $example
     * @return Term
     */
    public function addExample(\AppBundle\Entity\Example $example)
    {
        $this->examples[] = $example;
        $example->setTerm($this);

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


    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


    public function incrementVoteCount()
    {
        $this->setVotesCount( $this->getVotesCount() + 1 );
    }

}
