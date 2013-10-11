<?php

namespace matuck\AliasBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testDefault()
    {
        $client = static::createClient();

        //$crawler = $client->request('GET', '/hello/Fabien');
        //$this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
        $crawler = $client->request('GET', '/testredirect/testing');
        $this->assertTrue($crawler->filter('html:contains("testredirect")')->count() > 0);
        
        $crawler = $client->request('GET', '/test1');
        $this->assertTrue($crawler->filter('html:contains("test1")')->count() > 0 && $crawler->filter('html:contains("testredirect")')->count() > 0);
        
        $crawler = $client->request('GET', '/test2');
        $this->assertTrue($crawler->filter('html:contains("johndoe")')->count() > 0 && $crawler->filter('html:contains("testredirect")')->count() > 0);
        
        $crawler = $client->request('GET', '/test3');
        $this->assertTrue($client->getResponse()->isNotFound());
        
        $crawler = $client->request('GET', '/test4');
        $this->assertTrue($client->getResponse()->isNotFound());
    }
}
