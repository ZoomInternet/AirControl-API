<?php

namespace spec\AirControl\Api\Response;

use AirControl\Api\Response\Jobs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JobsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Jobs::class);
    }
}
