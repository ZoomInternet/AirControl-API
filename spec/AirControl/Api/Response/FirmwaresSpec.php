<?php

namespace spec\AirControl\Api\Response;

use AirControl\Api\Response\Firmwares;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FirmwaresSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Firmwares::class);
    }
}
