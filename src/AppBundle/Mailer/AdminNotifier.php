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
            //change email title based on alteration type
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

            //@todo better email contents in twig files

            //prepare the message
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom('info@wikebec.com')
                ->setTo('gsylvestre@gmail.com')
                ->setBody(
                    $this->templating->render(
                        //the file must be named according to $type
                        'emails/admin_notifications/'.$type.'_term.html.twig',
                        array('term' => $term)
                    ),
                    'text/html'
                )
            ;

            //sends it
            $this->mailer->send($message);
        }
    }