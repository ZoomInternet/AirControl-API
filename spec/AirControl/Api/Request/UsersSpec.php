<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Users;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Users::class);
    }
}
