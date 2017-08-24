<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Devices;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DevicesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Devices::class);
    }
}
