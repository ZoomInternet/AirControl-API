<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Alerts;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AlertsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Alerts::class);
    }
}
