<?php

    namespace AppBundle\Event;

    use Symfony\Component\EventDispatcher\Event;
    use AppBundle\Entity\Term;

    class TermAlterationEvent extends Event
    {
        protected $term;
        protected $type;

        public function __construct(Term $term, $type)
        {
            $this->term = $term;
            $this->type = $type;
        }

        public function getTerm()
        {
            return $this->term;
        }

        public function getType()
        {
            return $this->type;
        }
    }