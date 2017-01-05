<?php

namespace ServiceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testShowmotorcycle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showMotorcycle');
    }

    public function testShowaction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAction');
    }

    public function testChangeuserdetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/changeUserDetails');
    }

}
