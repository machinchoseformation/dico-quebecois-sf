<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Term;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction()
    {
        $wotdRepo = $this->getDoctrine()->getRepository("AppBundle:WordOfTheDay");
        $wotd = $wotdRepo->findTodaysWord();
        if (!$wotd){
            $wotd = $this->get("word_of_the_day_generator")->generate();
        }

        return $this->render('default/home.html.twig', compact("wotd"));
    }

    /**
     * @Route("/dico", name="dico")
     */
    public function dicoAction()
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $dico = $termRepo->findAllWithCategory();
        $params = array("dico" => $dico);
        return $this->render('default/dico.html.twig', $params);
    }

}
