<?php

namespace Phpeip\Integration\Core;

use Psr\Http\Message\MessageInterface;

/**
 * Base interface for any component that handles Messages.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
interface MessageHandlerInterface
{
    /**
     * Handles the message if possible.
     *
     * If the handler cannot deal with the message this will result in a `MessageRejectedException` e.g. in case of a
     * Selective Consumer. When a consumer tries to handle a message, but fails to do so, a `MessageHandlingException`
     * is thrown. In the last case it is recommended to treat the message as tainted and go into an error scenario.
     *
     * When the handling results in a failure of another message being sent (e.g. a "reply" message), that failure will
     * trigger a `MessageDeliveryException`.
     *
     * @param MessageInterface $message the message to be handled
     */
    public function handleMessage(MessageInterface $message);
}
