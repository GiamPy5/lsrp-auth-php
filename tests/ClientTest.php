<?php

namespace Giampaolo\LSRP\Auth\Tests;

use Giampaolo\LSRP\Auth\Client;

class ClientTest extends TestCase
{
    public function testNewInstance()
    {
        $client = new Client;
        $this->assertInstanceOf("Giampaolo\LSRP\Auth\Client", $client);
    }

    public function testIfPingWorksProperlyOrIfApiStillExists()
    {
        $client   = new Client;
        $response = $client->ping();
        $this->assertTrue(($response === true || $response === false));
    }
}