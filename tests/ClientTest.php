<?php

namespace Giampaolo\LSRP\Auth\Tests;

use Mockery as M;
use Giampaolo\LSRP\Auth\Client;

class ClientTest extends TestCase
{
    public function testNewInstance()
    {
        $client = M::mock("Giampaolo\LSRP\Auth\Client");
        $this->assertInstanceOf("Giampaolo\LSRP\Auth\Client", $client);
    }

    public function testIfPingWorksProperlyOrIfApiStillExists()
    {
        $client = M::mock("Giampaolo\LSRP\Auth\Client")->shouldReceive('ping')->andReturn(true)->getMock();

        $response = $client->ping();

        $this->assertTrue(($response === true || $response === false));
    }

    /**
     * @expectedException Giampaolo\LSRP\Auth\Exceptions\PingException
     */
    public function testIfPingDoesntWorkOrIfApiDoesNotExist()
    {
        $client = M::mock("Giampaolo\LSRP\Auth\Client")
            ->shouldReceive('ping')->with('wrong_website')->andThrow('Giampaolo\LSRP\Auth\Exceptions\PingException')->getMock();

        $response = $client->ping('wrong_website');
    }
}