<?php

    namespace AppBundle\Mailer;

    class AdminNotifier
    {

        private $mailer;
        private $templating;

        public function __construct($mailer, $templating)
        {
            $this->mailer = $mailer;
            $this->templating = $templating;
        }

        public function sendTermAlterationNotification($term, $type)
        {

            switch ($type){
                case "add":
                    $subject = "Nouveau terme sur Wikébec !";
                    break;
                case "edit":
                    $subject = "Terme modifié sur Wikébec !";
                    break;
                case "delete":
                    $subject = "Terme effacé de Wikébec !";
                    break;
            }

            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom('info@wikebec.com')
                ->setTo('gsylvestre@gmail.com')
                ->setBody(
                    $this->templating->render(
                        'emails/admin_notifications/'.$type.'_term.html.twig',
                        array('term' => $term)
                    ),
                    'text/html'
                )
            ;
            $this->mailer->send($message);
        }
    }