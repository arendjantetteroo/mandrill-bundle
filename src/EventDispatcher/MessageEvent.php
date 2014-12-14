<?php

namespace Shareworks\Bundle\MandrillBundle\EventDispatcher;

use JMS\Serializer\Annotation as Serializer;
use Shareworks\Component\Mandrill\Message\StatusMessage;

/**
 * Data container for message events.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 *
 * @link http://help.mandrill.com/entries/58303976-Message-Event-Webhook-format
 */
class MessageEvent extends AbstractEvent
{
    const HARD_BOUNCE = 'hard_bounce';
    const SOFT_BOUNCE = 'soft_bounce';
    const REJECT = 'reject';
    const UNSUBSCRIBE = 'unsub';
    const SPAM = 'spam';
    const SEND = 'send';
    const DEFERRAL = 'deferral';
    const OPEN = 'open';
    const CLICK = 'click';

    /**
     * @var string The message id
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var StatusMessage The message that this event is for
     * @Serializer\SerializedName("msg")
     * @Serializer\Type("Shareworks\Component\Mandrill\Message\StatusMessage")
     */
    protected $message;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return StatusMessage
     */
    public function getMessage()
    {
        return $this->message;
    }
}
