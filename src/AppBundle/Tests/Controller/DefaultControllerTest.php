<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * homepage basic tests
     */
    public function testHome()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Wikébec")')->count() > 0);
    }

    /**
     * best of page basic tests
     */
    public function testBestOf()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/coups-de-coeur');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //at least 10 terms showing...
        $this->assertGreaterThan(10, $crawler->filter('h3')->count());
    }

    /**
     * terms list basic tests
     */
    public function testDico()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/dico');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //at least 100 terms showing...
        $this->assertGreaterThan(100, $crawler->filter('li')->count());
    }


}
