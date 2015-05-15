<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\TermHistory;
use AppBundle\Event\TermAlterationEvent;
use Cocur\Slugify\Slugify;

class TermAlterationListener
{

    protected $doctrine;
    protected $adminNotifier;
    protected $request;
    protected $session;

    public function __construct($doctrine, $adminNotifier, $request_stack, $session)
    {
        $this->doctrine = $doctrine;
        $this->adminNotifier = $adminNotifier;

        //this is the way to get the request in a service (request stack)
        $this->request = $request_stack->getCurrentRequest();

        $this->session = $session;
    }

    /**
     * Called on create, update and delete of a term
     *
     * Sets a slug when needed, save a backup when needed, and sends admin notification
     *
     * @param TermAlterationEvent $event
     */
    public function onTermAlteration(TermAlterationEvent $event)
    {

        $em = $this->doctrine->getManager();

        $term = $event->getTerm();
        $type = $event->getType();

        //slug on add and edit
        if ($type == "add" || $type == "edit"){
            $slugify = new Slugify();
            $slug = $slugify->slugify($term->getName());
            $term->setSlug( $slug );
        }

        //backup on edit and delete
        if ($type == "edit" || $type == "delete") {
            //backup
            $termHistory = new TermHistory($term, $type);
            $termHistory->setIp( $this->request->getClientIp() );
            $termHistory->setEmail( $this->session->get('email') );
            $em->persist($termHistory);
        }

        //sends a notification on every alteration
        $this->adminNotifier->sendTermAlterationNotification($term, $type);
    }
}