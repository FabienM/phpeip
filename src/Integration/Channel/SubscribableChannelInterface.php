<?php

namespace Phpeip\Integration\Channel;

use Phpeip\Integration\Core\MessageHandlerInterface;
use Phpeip\Integration\MessageChannelInterface;

/**
 * Interface for any MessageChannel implementation that accepts subscribers.
 *
 * The subscribers must implement the MessageHandler interface and will be invoked when a Message is available.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
interface SubscribableChannelInterface extends MessageChannelInterface
{
    /**
     * Register a MessageHandler as a subscriber to this channel.
     *
     * @param MessageHandlerInterface $messageHandler
     * @return boolean
     */
    public function subscribe(MessageHandlerInterface $messageHandler);

    /**
     * Remove a MessageHandler from the subscribers of this channel.
     *
     * @param MessageHandlerInterface $messageHandler
     * @return boolean
     */
    public function unsubscribe(MessageHandlerInterface $messageHandler);
}
