<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Jobs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JobsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Jobs::class);
    }
}
