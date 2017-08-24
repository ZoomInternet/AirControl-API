<?php

namespace spec\AirControl\Api\Response;

use AirControl\Api\Response\Users;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Users::class);
    }
}
