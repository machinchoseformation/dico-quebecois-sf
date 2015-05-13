<?php

namespace AppBundle\Command;

use AppBundle\Entity\WordOfTheDay;

class WordOfTheDayGenerator
{
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return WordOfTheDay
     */
    public function generate()
    {

        $wotdRepo = $this->doctrine->getRepository("AppBundle:WordOfTheDay");

        //avoid duplicates
        $alreadyThere = $wotdRepo->findTodaysWord();
        if ($alreadyThere){
            return;
        }

        //find quality terms ids
        $termRepo = $this->doctrine->getRepository("AppBundle:Term");
        $qualityIds = $termRepo->findAllQualityWordIds();


        //@todo: check in previous wotds to avoid having the same one multiple times


        //randomize
        shuffle($qualityIds);
        $id = array_pop($qualityIds)["id"];

        //retrieve the term
        $term = $termRepo->find($id);

        //save a new entry in wotd
        $wotd = new WordOfTheDay($term);
        $em = $this->doctrine->getManager();
        $em->persist($wotd);
        $em->flush();

        return $wotd;
    }

} 