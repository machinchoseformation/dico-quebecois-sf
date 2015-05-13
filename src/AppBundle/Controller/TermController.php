<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Example;
use AppBundle\Entity\Term;
use AppBundle\Entity\Definition;
use AppBundle\Entity\TermHistory;
use AppBundle\Entity\TermVote;
use AppBundle\Event\TermAlterationEvent;
use Cocur\Slugify\Slugify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\EventDispatcher\EventDispatcher;

use AppBundle\Form\TermType;
use AppBundle\Form\DeleteTermType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TermController
 * @package AppBundle\Controller
 */
class TermController extends Controller
{

    /**
     * @Route("/{slug}/definition", name="showTerm")
     */
    public function showTermAction(Term $term)
    {
        return $this->render('term/show_term.html.twig', compact("term"));
    }


    /**
     * @Route("/terme/suppression/{slug}", name="deleteTerm")
     */
    public function deleteTerm(Request $request, Term $term)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createForm(new DeleteTermType(), $term);
        $deleteForm->get('email')->setData( $this->get('session')->get('email') );

        $deleteForm->handleRequest($request);
        if ($deleteForm->isValid()){

            $this->get('session')->set('email', $deleteForm->get('email')->getData());

            $this->dispatchAlterationEvent($term, "delete");

            $em->remove($term);
            $em->flush();

            $this->addFlash('success', 'Terme effacé !');
            //return $this->redirectToRoute('home');
        }

        $params = array(
            "term" => $term,
            "deleteForm" => $deleteForm->createView()
        );
        return $this->render('term/delete_term.html.twig', $params);
    }


    /**
     * @Route("/terme/ajout", name="addTerm")
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
        $termForm->get('email')->setData( $this->get('session')->get('email') );

        $termForm->handleRequest($request);
        if ($termForm->isValid()){

            $this->get('session')->set('email', $termForm->get('email')->getData());

            $this->dispatchAlterationEvent($term, "add");

            $em->persist($term);
            $em->flush();

            $this->addFlash('success', 'Nouveau terme enregistré !');
            return $this->redirectToRoute('showTerm', array('slug' => $term->getSlug()));
        }

        $params = array(
            "termForm" => $termForm->createView()
        );
        return $this->render('term/add_term.html.twig', $params);
    }

    /**
     * @Route("/terme/modification/{slug}", name="editTerm")
     */
    public function editTermAction(Request $request, Term $term)
    {

        $em = $this->getDoctrine()->getManager();

        //add definitions and example field if none...
        if (count($term->getDefinitions()) < 1){
            $emptyDefinition = new Definition();
            $term->addDefinition($emptyDefinition);
        }

        if (count($term->getExamples()) < 1){
            $emptyExample = new Example();
            $term->addExample($emptyExample);
        }

        $termForm = $this->createForm(new TermType(), $term);
        $termForm->get('email')->setData( $this->get('session')->get('email') );

        $termForm->handleRequest($request);
        if ($termForm->isValid()){

            $this->get('session')->set('email', $termForm->get('email')->getData());

            $this->dispatchAlterationEvent($term, "edit");

            $em->persist($term);
            $em->flush();

            $this->addFlash('success', 'Terme enregistré !');
            return $this->redirectToRoute('showTerm', array('slug' => $term->getSlug()));
        }

        $params = array(
            "term" => $term,
            "termForm" => $termForm->createView()
        );
        return $this->render('term/edit_term.html.twig', $params);
    }


    /**
     * @Route("vote/{id}", name="voteTerm")
     */
    public function voteTermAction(Request $request, Term $term)
    {
        $voteRepo = $this->getDoctrine()->getRepository("AppBundle:TermVote");

        $ip = $request->getClientIp();

        if ($voteRepo->findExisting($ip, $term)){
            $this->addFlash("warning", "Vous avez déjà voté pour cette entrée !");
        }
        else {
            $vote = new TermVote($ip, $term);

            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);

            $term->incrementVoteCount();

            $em->flush();

            $this->addFlash("success", "Merci pour votre vote !");
        }

        return $this->redirectToRoute("showTerm", array("slug" => $term->getSlug()));
    }

    protected function dispatchAlterationEvent($term, $type)
    {
        $termAlterationEvent = new TermAlterationEvent($term, $type);
        $eventDispatcher = $this->get('event_dispatcher');
        $eventDispatcher->dispatch("term_alteration", $termAlterationEvent);
    }
} 