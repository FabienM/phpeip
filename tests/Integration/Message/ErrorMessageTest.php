<?php

namespace Phpeip\Integration\Message;

use Symfony\Component\Yaml\Exception\RuntimeException;

class ErrorMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param mixed $payload
     * @dataProvider badPayloadsProvider
     * @expectedException Phpeip\Integration\Exception\InvalidPayloadException
     */
    public function testCheckPayloadFails($payload)
    {
        $message = new ErrorMessage();
        $message->withPayload($payload);
    }

    public function testCheckPayload()
    {
        $message = new ErrorMessage();
        $new = $message->withPayload(new \RuntimeException());
        $this->assertInstanceOf('RuntimeException', $new->getPayload());
    }

    public function badPayloadsProvider()
    {
        return [
            ["test"],
            [new \stdClass()]
        ];
    }
}
