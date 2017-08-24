<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Roles;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RolesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Roles::class);
    }
}
