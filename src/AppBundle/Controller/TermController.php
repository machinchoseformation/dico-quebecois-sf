<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Example;
use AppBundle\Entity\Term;
use AppBundle\Entity\Definition;
use AppBundle\Entity\TermVote;
use AppBundle\Event\TermAlterationEvent;
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
     * Show term details page
     *
     * @Route("/{slug}/definition", name="showTerm")
     */
    public function showTermAction(Term $term)
    {
        return $this->render('term/show_term.html.twig', compact("term"));
    }


    /**
     * Deletes a term
     *
     * @Route("/terme/suppression/{slug}", name="deleteTerm")
     */
    public function deleteTerm(Request $request, Term $term)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createForm(new DeleteTermType(), $term);

        //prefill the email in the form if stored in session
        $deleteForm->get('email')->setData( $this->get('session')->get('email') );

        $deleteForm->handleRequest($request);
        if ($deleteForm->isValid()){

            //store the email in session to prefill next form
            $this->get('session')->set('email', $deleteForm->get('email')->getData());

            //dispatch a term alteration event, type delete
            $this->dispatchAlterationEvent($term, "delete");

            $em->remove($term);
            $em->flush();

            $this->addFlash('success', 'Terme effacé !');
            return $this->redirectToRoute('home');
        }

        $params = array(
            "term" => $term,
            "deleteForm" => $deleteForm->createView()
        );
        return $this->render('term/delete_term.html.twig', $params);
    }


    /**
     * Shows and handles the add term form
     *
     * @Route("/terme/ajout", name="addTerm")
     */
    public function addTermAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $term = new Term();

        //so that we see a definition field automatically
        $emptyDefinition = new Definition();
        $term->addDefinition($emptyDefinition);

        //same for example
        $emptyExample = new Example();
        $term->addExample($emptyExample);

        $termForm = $this->createForm(new TermType(), $term);

        //prefill the email in form if stored in session
        $termForm->get('email')->setData( $this->get('session')->get('email') );

        $termForm->handleRequest($request);
        if ($termForm->isValid()){

            //store the email in session for later use
            $this->get('session')->set('email', $termForm->get('email')->getData());

            //dispatch term alteration event, type add
            $this->dispatchAlterationEvent($term, "add");

            $em->persist($term);
            $em->flush();

            $this->addFlash('success', 'Nouveau terme enregistré !');

            //redirect on the newly added term
            return $this->redirectToRoute('showTerm', array('slug' => $term->getSlug()));
        }

        $params = array(
            "termForm" => $termForm->createView()
        );
        return $this->render('term/add_term.html.twig', $params);
    }

    /**
     * Shows the edit term page and handles the form
     *
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

        //prefill the email
        $termForm->get('email')->setData( $this->get('session')->get('email') );

        $termForm->handleRequest($request);
        if ($termForm->isValid()){

            //store the email in session
            $this->get('session')->set('email', $termForm->get('email')->getData());

            //dispatch term edit event
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
     * Register the vote
     * @todo ajax request insted of http
     *
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

            //could have been automatized, but hey
            $term->incrementVoteCount();

            //saves the vote and the term
            $em->flush();

            $this->addFlash("success", "Merci pour votre vote !");
        }

        return $this->redirectToRoute("showTerm", array("slug" => $term->getSlug()));
    }

    /**
     * Dispatch a term alteration event
     *
     * Just to dry some code
     *
     * @param $term
     * @param $type
     */
    protected function dispatchAlterationEvent(Term $term, $type)
    {
        $termAlterationEvent = new TermAlterationEvent($term, $type);
        $eventDispatcher = $this->get('event_dispatcher');
        $eventDispatcher->dispatch("term_alteration", $termAlterationEvent);
    }
} 