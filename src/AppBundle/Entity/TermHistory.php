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
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var Category
     *
     * @ORM\Column(name="serializedCategory", type="object")
     */
    private $serializedCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="serializedDefinitions", type="object")
     */
    private $serializedDefinitions;

    /**
     * @var string
     *
     * @ORM\Column(name="serializedExamples", type="object")
     */
    private $serializedExamples;


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
        $this->setSerializedDefinitions( $term->getDefinitions() );
        $this->setSerializedExamples( $term->getExamples() );
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
     * Set serializedDefinitions
     *
     * @param array $serializedDefinitions
     * @return TermHistory
     */
    public function setSerializedDefinitions($serializedDefinitions)
    {
        $this->serializedDefinitions = $serializedDefinitions;

        return $this;
    }

    /**
     * Get serializedDefinitions
     *
     * @return array 
     */
    public function getSerializedDefinitions()
    {
        return $this->serializedDefinitions;
    }

    /**
     * Set serializedExamples
     *
     * @param array $serializedExamples
     * @return TermHistory
     */
    public function setSerializedExamples($serializedExamples)
    {
        $this->serializedExamples = $serializedExamples;

        return $this;
    }

    /**
     * Get serializedExamples
     *
     * @return array 
     */
    public function getSerializedExamples()
    {
        return $this->serializedExamples;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return TermHistory
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
     * Set email
     *
     * @param string $email
     * @return TermHistory
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
