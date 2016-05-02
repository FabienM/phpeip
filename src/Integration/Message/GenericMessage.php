<?php

namespace Phpeip\Integration\Message;

use GuzzleHttp\Psr7\MessageTrait;
use Phpeip\Integration\Exception\InvalidPayloadException;
use Psr\Http\Message\MessageInterface;

/**
 * Base Message class defining common properties such as id, payload, and headers. Once created this object is immutable.
 * @author Fabien Meurillon <fabien@meurillon.org>
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class GenericMessage implements MessageInterface
{
    use MessageTrait;

    const CONTENT_TYPE = "content-type";
    const CORRELATION_ID = "correlationId";
    const ERROR_CHANNEL = "errorChannel";
    const EXPIRATION_DATE = "expirationDate";
    const ID = "id";
    const POSTPROCESS_RESULT = "postProcessResult";
    const PRIORITY = "priority";
    const REPLY_CHANNEL = "replyChannel";
    const SEQUENCE_DETAILS = "sequenceDetails";
    const SEQUENCE_NUMBER = "sequenceNumber";
    const SEQUENCE_SIZE = "sequenceSize";
    const TIMESTAMP = "timestamp";

    /** @var mixed */
    private $payload;

    public function getContentType()
    {
        return $this->getHeader(self::CONTENT_TYPE);
    }

    public function getCorrelationId()
    {
        return $this->getHeader(self::CORRELATION_ID);
    }

    public function getErrorChannel()
    {
        return $this->getHeader(self::ERROR_CHANNEL);
    }

    public function getExpirationDate()
    {
        return $this->getHeader(self::EXPIRATION_DATE);
    }

    public function getId()
    {
        return $this->getHeader(self::ID);
    }

    public function getPostProcessResult()
    {
        return $this->getHeader(self::POSTPROCESS_RESULT);
    }

    public function getPriority()
    {
        return $this->getHeader(self::PRIORITY);
    }

    public function getReplyChannel()
    {
        return $this->getHeader(self::REPLY_CHANNEL);
    }

    public function getSequenceDetails()
    {
        return $this->getHeader(self::SEQUENCE_DETAILS);
    }

    public function getSequenceNumber()
    {
        return $this->getHeader(self::SEQUENCE_NUMBER);
    }

    public function getSequenceSize()
    {
        return $this->getHeader(self::SEQUENCE_SIZE);
    }

    public function getTimestamp()
    {
        return $this->getHeader(self::TIMESTAMP);
    }

    final public function withContentType($contentType)
    {
        return $this->withHeader(self::CONTENT_TYPE, $contentType);
    }

    final public function withCorrelationId($correlationId)
    {
        return $this->withHeader(self::CORRELATION_ID, $correlationId);
    }

    final public function withErrorChannel($errorChannel)
    {
        return $this->withHeader(self::ERROR_CHANNEL, $errorChannel);
    }

    final public function withExpirationDate($expirationDate)
    {
        return $this->withHeader(self::EXPIRATION_DATE, $expirationDate);
    }

    final public function withId($identifier)
    {
        return $this->withHeader(self::ID, $identifier);
    }

    final public function withPostProcessResult($postProcessResult)
    {
        return $this->withHeader(self::POSTPROCESS_RESULT, $postProcessResult);
    }

    final public function withPriority($priority)
    {
        return $this->withHeader(self::PRIORITY, $priority);
    }

    final public function withReplyChannel($replyChannel)
    {
        return $this->withHeader(self::REPLY_CHANNEL, $replyChannel);
    }

    final public function withSequenceDetails($sequenceDetails)
    {
        return $this->withHeader(self::SEQUENCE_DETAILS, $sequenceDetails);
    }

    final public function withSequenceNumber($sequenceNumber)
    {
        return $this->withHeader(self::SEQUENCE_NUMBER, $sequenceNumber);
    }

    final public function withSequenceSize($sequenceSize)
    {
        return $this->withHeader(self::SEQUENCE_SIZE, $sequenceSize);
    }

    final public function withTimestamp($timestamp)
    {
        return $this->withHeader(self::TIMESTAMP, $timestamp);
    }

    public function getPayload()
    {
        return $this->payload;
    }

    final public function withPayload($payload)
    {
        if ($payload === $this->payload) {
            return $this;
        }

        $this->checkPayload($payload);
        
        $new = clone $this;
        $new->payload = $payload;
        return $new->withBody(\GuzzleHttp\Psr7\stream_for(serialize($payload)));
    }

    /**
     * This method may be overridden to reject a unsupported payload.
     *
     * Override it to implement your custom payload validation, generally type-based.
     * @param $payload the payload to check
     * @throws InvalidPayloadException if the payload should be rejected
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function checkPayload($payload)
    {
        return;
    }
}
