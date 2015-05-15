<?php

    namespace AppBundle\Event;

    use Symfony\Component\EventDispatcher\Event;
    use AppBundle\Entity\Term;

    /**
     * Simple Event holding info about the term, and the alteration type
     *
     * See AppBundle\EvenLIstener\TermAlterationListener
     *
     * Class TermAlterationEvent
     * @package AppBundle\Event
     */
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