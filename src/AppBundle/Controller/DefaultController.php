<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Term;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Shows the homepage, with the Word of the Day
     *
     * @Route("/", name="home")
     */
    public function homeAction()
    {
        $wotdRepo = $this->getDoctrine()->getRepository("AppBundle:WordOfTheDay");
        $wotd = $wotdRepo->findTodaysWord();

        //just in case the cron job didn't work
        if (!$wotd){
            $wotd = $this->get("word_of_the_day_generator")->generate();
        }

        return $this->render('default/home.html.twig', compact("wotd"));
    }

    /**
     * Shows the best of page (words with the most votes)
     *
     * @Route("/coups-de-coeur", name="bestOf")
     */
    public function bestOfAction()
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $terms = $termRepo->findBestOf();

        return $this->render('default/best_of.html.twig', compact("terms"));
    }

    /**
     * Renders only the terms list, and the filters. Called from base.html.twig
     *
     * @Route("/dico", name="dico")
     */
    public function dicoAction()
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $dico = $termRepo->findAllWithCategory();

        return $this->render('default/dico.html.twig', compact("dico"));
    }

}
