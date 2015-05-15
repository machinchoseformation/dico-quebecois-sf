<?php

namespace AppBundle\Command;


use AppBundle\Entity\WordOfTheDay;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Simple command to generate a new Word of the day
 *
 * Class WordOfTheDayGeneratorCommand
 * @package AppBundle\Command
 */
class WordOfTheDayGeneratorCommand extends ContainerAwareCommand
{

    protected $wotdGenerator;

    /**
     * Called by the service container
     *
     * @param WordOfTheDayGenerator $wotdGenerator
     */
    public function __construct(WordOfTheDayGenerator $wotdGenerator)
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