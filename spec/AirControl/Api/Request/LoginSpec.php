<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Login;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoginSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Login::class);
    }
}
