<?php

namespace spec\AirControl\Api;

use GuzzleHttp\Client as HttpClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{

    /**
     * @param \GuzzleHttp\Client|\PhpSpec\Wrapper\Collaborator $client
    */
    function let(HttpClient $client)
    {
        $this->beConstructedWith('127.0.0.1', 'admin', 'aircontrol', $client);
       // $request->send()->willReturn($response);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AirControl\Api\Client');
    }


    function it_has_selected_api_url()
    {
        $this->getApiUrl()->shouldReturn('https://127.0.0.1:9082/api');
    }
}
