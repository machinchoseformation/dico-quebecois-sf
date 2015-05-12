<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Example;
use AppBundle\Entity\Term;
use AppBundle\Entity\Definition;
use Cocur\Slugify\Slugify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\TermType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TermController
 * @package AppBundle\Controller
 * @Route("/terme")
 */
class TermController extends Controller {

    /**
     * @Route("/ajout", name="addTerm")
     */
    public function addTermAction(Request $request)
    {
        $termRepo = $this->getDoctrine()->getRepository("AppBundle:Term");
        $em = $this->getDoctrine()->getManager();

        $term = new Term();
        $emptyDefinition = new Definition();
        $term->addDefinition($emptyDefinition);

        $emptyExample = new Example();
        $term->addExample($emptyExample);

        $termForm = $this->createForm(new TermType(), $term);

        $termForm->handleRequest($request);

        if ($termForm->isValid()){

            $slugify = new Slugify();
            $slug = $slugify->slugify($term->getName());
            $term->setSlug( $slug );

            $em->persist($term);
            $em->flush();

            $this->addFlash('success', 'Nouveau terme enregistré !');
            return $this->redirectToRoute('term', array('slug' => $slug));
        }

        dump($term);

        $params = array(
            "termForm" => $termForm->createView()
        );
        return $this->render('term/add_term.html.twig', $params);
    }

    /**
     * @Route("/modification/{slug}", name="editTerm")
     */
    public function editTermAction(Request $request, Term $term)
    {

        $em = $this->getDoctrine()->getManager();

        if (count($term->getDefinitions()) < 1){
            $emptyDefinition = new Definition();
            $term->addDefinition($emptyDefinition);
        }

        if (count($term->getExamples()) < 1){
            $emptyExample = new Example();
            $term->addExample($emptyExample);
        }

        $termForm = $this->createForm(new TermType(), $term);

        $termForm->handleRequest($request);

        if ($termForm->isValid()){

            $slugify = new Slugify();
            $slug = $slugify->slugify($term->getName());
            $term->setSlug( $slug );

            $em->persist($term);
            $em->flush();

            $this->addFlash('success', 'Terme enregistré !');
            return $this->redirectToRoute('term', array('slug' => $slug));
        }

        dump($term);

        $params = array(
            "term" => $term,
            "termForm" => $termForm->createView()
        );
        return $this->render('term/edit_term.html.twig', $params);
    }
} 