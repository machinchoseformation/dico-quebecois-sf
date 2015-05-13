<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\TermHistory;
use AppBundle\Event\TermAlterationEvent;
use Cocur\Slugify\Slugify;

class TermAlterationListener
{

    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
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
    }
}