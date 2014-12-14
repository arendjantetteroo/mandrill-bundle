<?php

namespace Shareworks\Bundle\MandrillBundle\EventDispatcher;

use JMS\Serializer\Annotation as Serializer;
use Shareworks\Component\Mandrill\Email\IncomingMessage;

class InboundEvent extends AbstractEvent
{
    const INBOUND = 'inbound';

    /**
     * @var IncomingMessage
     * @Serializer\SerializedName("msg")
     * @Serializer\Type("Shareworks\Component\Mandrill\Email\IncomingMessage")
     */
    protected $message;

    public function getMessage()
    {
        return $this->message;
    }
}
