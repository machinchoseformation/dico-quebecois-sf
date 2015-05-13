<?php

namespace AppBundle\Command;


use AppBundle\Entity\WordOfTheDay;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WordOfTheDayGeneratorCommand extends ContainerAwareCommand
{

    protected $wotdGenerator;

    public function __construct($wotdGenerator)
    {
        parent::__construct();
        $this->wotdGenerator = $wotdGenerator;
    }

    public function configure()
    {
        $this->setName("dico:word_of_the_day")
            ->setDescription("Generates a new Word of the Day");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->wotdGenerator->generate();
    }

} 