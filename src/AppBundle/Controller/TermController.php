<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Example;
use AppBundle\Entity\Term;
use AppBundle\Entity\Definition;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\TermType;

/**
 * Class TermController
 * @package AppBundle\Controller
 * @Route("/terme")
 */
class TermController extends Controller {

    /**
     * @Route("/ajout", name="addTerm")
     */
    public function addTermAction()
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $em = $this->getDoctrine()->getManager();

        $term = new Term();
        $emptyDefinition = new Definition();
        $term->addDefinition($emptyDefinition);

        $emptyExample = new Example();
        $term->addExample($emptyExample);

        $termForm = $this->createForm(new TermType(), $term);

        if ($termForm->isValid()){

            $em->persist($term);
            $em->flush();

        }

        $params = array(
            "termForm" => $termForm->createView()
        );
        return $this->render('term/add_term.html.twig', $params);
    }

    /**
     * @Route("/modification/{slug}", name="editTerm")
     */
    public function editTermAction(Term $term)
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $em = $this->getDoctrine()->getManager();

        $params = array();
        return $this->render('default/edit_term.html.twig', $params);
    }
} 