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
        $this->request = $request_stack->getCurrentRequest();
        $this->session = $session;
    }

    public function onTermAlteration(TermAlterationEvent $event)
    {

        $em = $this->doctrine->getManager();

        $term = $event->getTerm();
        $type = $event->getType();

        if ($type == "add" || $type == "edit"){
            $slugify = new Slugify();
            $slug = $slugify->slugify($term->getName());
            $term->setSlug( $slug );
        }

        if ($type == "edit" || $type == "delete") {
            //backup
            $termHistory = new TermHistory($term, $type);
            $termHistory->setIp( $this->request->getClientIp() );
            $termHistory->setEmail( $this->session->get('email') );
            $em->persist($termHistory);
        }

        //send a notification
        $this->adminNotifier->sendTermAlterationNotification($term, $type);
    }
}