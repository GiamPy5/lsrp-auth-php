<?php

namespace Giampaolo\LSRP\Auth\Tests;

use Mockery as M;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }
}