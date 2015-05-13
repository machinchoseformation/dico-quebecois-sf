<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\TermHistory;
use AppBundle\Event\TermAlterationEvent;
use Cocur\Slugify\Slugify;

class TermAlterationListener
{

    protected $doctrine;
    protected $adminNotifier;

    public function __construct($doctrine, $adminNotifier)
    {
        $this->doctrine = $doctrine;
        $this->adminNotifier = $adminNotifier;
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
            $em->persist($termHistory);
        }

        //send a notification
        $this->adminNotifier->sendTermAlterationNotification($term, $type);
    }
}