<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Networks;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NetworksSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Networks::class);
    }
}
