<?php

namespace ServiceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ManagerControllerTest extends WebTestCase
{
    public function testAdduser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addUser');
    }

    public function testModifyuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifyUser');
    }

    public function testAddaction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addAction');
    }

    public function testModifyaction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifyAction');
    }

    public function testAddmotorcycle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addMotorcycle');
    }

    public function testModifymotorcycle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifyMotorcycle');
    }

}
