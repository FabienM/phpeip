<?php

namespace Phpeip\Integration\Message;

use Phpeip\Integration\Exception\InvalidPayloadException;

/**
 * A message implementation that accepts an Exception payload. Once created this object is immutable.
 * @author Fabien Meurillon <fabien@meurillon.org>
 */
class ErrorMessage extends GenericMessage
{
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
        if ($payload instanceof \Exception) {
            return;
        }
        $type = gettype($payload);
        if (is_object($payload)) {
            $type = get_class($payload);
        }
        throw new InvalidPayloadException(
            sprintf("The payload should be an instance of Exception. %s found.", $type)
        );
    }

}
