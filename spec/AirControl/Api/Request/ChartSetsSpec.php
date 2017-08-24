<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\ChartSets;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChartSetsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ChartSets::class);
    }
}
