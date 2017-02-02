<?php

namespace Phpeip\Integration\Channel\Pollable;

use Phpeip\Integration\Channel\PollableChannelInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Log\LoggerInterface;

/**
 * A channel implementation that essentially behaves like "/dev/null".
 *
 * All receive() calls will return null, and all send() calls will return true although no action is performed.
 * Note however that the invocations are logged
 * at debug-level.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
class NullChannel implements PollableChannelInterface
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * NullChannel constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

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
    public function send(MessageInterface $message)
    {
        $this->logInvocation('send', $message);
        return true;
    }

    /**
     * Send a message, blocking until either the message is accepted or the specified timeout period elapses.
     *
     * @param MessageInterface $message the message to send
     * @param int $timeout the timeout in milliseconds
     * @return boolean `false` if the specified timeout period elapses or the send is interrupted, `true` otherwise
     */
    public function sendWithTimeout(MessageInterface $message, $timeout)
    {
        $this->logInvocation('sendWithTimeout', $message, $timeout);
        return true;
    }

    /**
     * Receive a message from this channel, blocking indefinitely if necessary.
     * @return MessageInterface the next available Message or null if interrupted
     */
    public function receive()
    {
        $this->logInvocation('receive');
        return null;
    }

    /**
     * Receive a message from this channel, blocking until either a message is available or the specified timeout period
     * elapses.
     *
     * @param int $timeout the timeout in milliseconds
     * @return MessageInterface the next available Message or null if the specified timeout period elapses or the message reception is interrupted
     */
    public function receiveWithTimeout($timeout)
    {
        $this->logInvocation('receiveWithTimeout', null, $timeout);
        return null;
    }

    private function logInvocation($method, MessageInterface $message = null, $timeout = null)
    {
        $this->logger->debug(
            'NullChannel {method} invocation',
            [
                'method' => $method,
                'body' => $message !== null ?: \GuzzleHttp\Psr7\copy_to_string($message->getBody()),
                'headers' => $message !== null ?: $message->getHeaders(),
                'timeout' => $timeout
            ]
        );
        return true;
    }
}
