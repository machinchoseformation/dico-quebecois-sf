<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Term;
use AppBundle\Entity\Definition;
use AppBundle\Entity\Example;

class LoadTerms implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        if (($handle = fopen(__DIR__ . "/dico.csv", "r")) !== FALSE) {
            $num = 0;
            while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num++;
                if ($num == 1){continue;}

                //remove empty string and NULL strings
                for($i=0;$i<count($cols);$i++){
                    if (empty($cols[$i]) ||  strtoupper($cols[$i]) == "NULL"
                        ||  strtoupper($cols[$i]) == "NA"){
                        $cols[$i] = null;
                    }
                }


                /*
                0"terme"
                1"Definition 1"
                2"Definition 2"
                3"Catégorie"
                4"Exemple #1"
                5"Traduction de l'exemple 1"
                6"Variations "
                7"Prononciation"
                8"nature"
                9"genre"
                10"nombre"
                11"Origine"
                12"Date de création"
                13"Dernière modification"
                14"Nombre de votes"
                */
                $term = new Term();
                $term->setName($cols[0]);

                $term->setVariations($cols[6]);
                $term->setPronunciation($cols[7]);
                $term->setNature($cols[8]);
                $term->setGender($cols[9]);
                $term->setNumber($cols[10]);
                $term->setOrigin($cols[11]);
                $created = new \DateTime();
                //fix empty date
                if (!is_numeric($cols[12]) || !is_numeric($cols[13])){
                    $cols[12] = time();
                    $cols[13] = time();
                }
                $term->setCreatedDate($created->setTimestamp($cols[12]));
                $modified = new \DateTime();
                $term->setModifiedDate($modified->setTimestamp($cols[13]));
                //no votes = 0 vote
                $votes = (empty($cols[14])) ? 0 : $cols[14];
                $term->setVotesCount($votes);

                $em->persist($term);
            }
            $em->flush();
            fclose($handle);
        }
    }
}