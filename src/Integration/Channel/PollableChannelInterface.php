<?php

namespace Phpeip\Integration\Channel;

use Phpeip\Integration\MessageChannelInterface;
use Psr\Http\Message\MessageInterface;

/**
 * Interface for Message Channels from which Messages may be actively received through polling.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
interface PollableChannelInterface extends MessageChannelInterface
{
    /**
     * Receive a message from this channel, blocking indefinitely if necessary.
     * @return MessageInterface the next available Message or null if interrupted
     */
    public function receive();

    /**
     * Receive a message from this channel, blocking until either a message is available or the specified timeout period
     * elapses.
     *
     * @param int $timeout the timeout in milliseconds
     * @return MessageInterface the next available Message or null if the specified timeout period elapses or the message reception is interrupted
     */
    public function receiveWithTimeout($timeout);
}
