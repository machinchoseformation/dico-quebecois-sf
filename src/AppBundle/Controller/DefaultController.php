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
        return $this->render('default/home.html.twig');
    }

    /**
     * @Route("/{slug}/definition", name="term")
     */
    public function termAction(Term $term)
    {
        $params = array();
        $params['term'] = $term;
        return $this->render('default/term.html.twig', $params);
    }

    /**
     * @Route("/dico", name="dico")
     */
    public function dicoAction()
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $dico = $termRepo->findBy(array(), array("name" => "ASC"));
        $params = array("dico" => $dico);
        return $this->render('default/dico.html.twig', $params);
    }

}
