<?php

namespace spec\AirControl\Api\Response;

use AirControl\Api\Response\Devices;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DevicesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Devices::class);
    }
}
