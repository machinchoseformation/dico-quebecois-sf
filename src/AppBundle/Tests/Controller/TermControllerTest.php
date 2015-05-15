<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TermControllerTest extends WebTestCase
{
    /**
     * homepage basic tests
     */
    public function testShowTerm()
    {
        $client = static::createClient();

        //first get some links from the list
        $crawler = $client->request('GET', '/dico');

        $links = $crawler->filter("#dico a")
            ->reduce(function ($node, $i) {
                //one on one hundred only
                return !($i%100);
            });

        //get all single pages one by one
        $links->each(function($node, $i) use ($client){
            $link = $node->link();
            $showTermPageCrawler = $client->click($link);

            $termName = $node->text();
            fwrite(STDERR, print_r($showTermPageCrawler->filter('h1')->text(), TRUE));;

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
            $this->assertEquals($termName, $showTermPageCrawler->filter('h1')->text());
        });


    }

}
