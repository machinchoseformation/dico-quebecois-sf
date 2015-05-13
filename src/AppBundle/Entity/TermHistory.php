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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="backupDate", type="datetime")
     */
    private $backupDate;

    /**
     * @var Category
     *
     * @ORM\Column(name="serializedCategory", type="object")
     */
    private $serializedCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="jsonDefinitions", type="object")
     */
    private $jsonDefinitions;

    /**
     * @var string
     *
     * @ORM\Column(name="jsonExamples", type="object")
     */
    private $jsonExamples;


    /**
     * Constructor
     */
    public function __construct(Term $term, $type = null)
    {

        $this->setType($type);

        //not elegant, but casting with inheritance is a bitch
        $this->setName( $term->getName() );
        $this->setSlug( $term->getSlug() );
        $this->setVariations( $term->getVariations() );
        $this->setPronunciation( $term->getPronunciation() );
        $this->setNature( $term->getNature() );
        $this->setGender( $term->getGender() );
        $this->setNumber( $term->getNumber() );
        $this->setOrigin( $term->getOrigin() );
        $this->setCreatedDate( $term->getCreatedDate() );
        $this->setModifiedDate( $term->getModifiedDate() );
        $this->setVotesCount( $term->getVotesCount() );

        $this->setBackupDate(new \DateTime());
        $this->setJsonDefinitions( $term->getDefinitions() );
        $this->setJsonExamples( $term->getExamples() );
        $this->setSerializedCategory( $term->getCategory() );

    }


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getBackupDate()
    {
        return $this->backupDate;
    }

    /**
     * @param \DateTime $backupDate
     */
    public function setBackupDate($backupDate)
    {
        $this->backupDate = $backupDate;
    }


    /**
     * Set serializedCategory
     *
     * @param \stdClass $serializedCategory
     * @return TermHistory
     */
    public function setSerializedCategory($serializedCategory)
    {
        $this->serializedCategory = $serializedCategory;

        return $this;
    }

    /**
     * Get serializedCategory
     *
     * @return \stdClass 
     */
    public function getSerializedCategory()
    {
        return $this->serializedCategory;
    }

    /**
     * Set jsonDefinitions
     *
     * @param array $jsonDefinitions
     * @return TermHistory
     */
    public function setJsonDefinitions($jsonDefinitions)
    {
        $this->jsonDefinitions = $jsonDefinitions;

        return $this;
    }

    /**
     * Get jsonDefinitions
     *
     * @return array 
     */
    public function getJsonDefinitions()
    {
        return $this->jsonDefinitions;
    }

    /**
     * Set jsonExamples
     *
     * @param array $jsonExamples
     * @return TermHistory
     */
    public function setJsonExamples($jsonExamples)
    {
        $this->jsonExamples = $jsonExamples;

        return $this;
    }

    /**
     * Get jsonExamples
     *
     * @return array 
     */
    public function getJsonExamples()
    {
        return $this->jsonExamples;
    }
}
