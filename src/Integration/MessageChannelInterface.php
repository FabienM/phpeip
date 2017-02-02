<?php

namespace Phpeip\Integration;

use Psr\Http\Message\MessageInterface;

/**
 * Base channel interface defining common behavior for sending messages.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
interface MessageChannelInterface
{
    /**
     * Send a Message to this channel. May throw a RuntimeException for non-recoverable errors.
     *
     * Otherwise, if the Message cannot be sent for a non-fatal reason this method will return 'false', and if the
     * Message is sent successfully, it will return 'true'.
     * Depending on the implementation, this method may block indefinitely. To provide a maximum wait time, use
     * `sendWithTimeout(Message, int)`.
     * @param MessageInterface $message the message to send
     * @return boolean whether or not the Message has been sent successfully
     */
    public function send(MessageInterface $message);

    /**
     * Send a message, blocking until either the message is accepted or the specified timeout period elapses.
     *
     * @param MessageInterface $message the message to send
     * @param int $timeout the timeout in milliseconds
     * @return boolean `false` if the specified timeout period elapses or the send is interrupted, `true` otherwise
     */
    public function sendWithTimeout(MessageInterface $message, $timeout);
}
