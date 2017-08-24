<?php

namespace spec\AirControl\Api\Request;

use AirControl\Api\Request\Settings;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SettingsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Settings::class);
    }
}
