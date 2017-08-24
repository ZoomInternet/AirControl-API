<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Eula;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EulaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Eula::class);
    }
}
