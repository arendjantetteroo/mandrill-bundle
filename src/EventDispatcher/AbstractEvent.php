<?php

namespace Shareworks\Bundle\MandrillBundle\EventDispatcher;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\EventDispatcher\Event;

/**
 * Base Mandrill event.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 * @Serializer\Discriminator(field="event", map={
 *     "whitelist": "SyncEvent",
 *     "blacklist": "SyncEvent",
 *     "inbound": "InboundEvent",
 *     "hard_bounce": "MessageEvent",
 *     "soft_bounce": "MessageEvent",
 *     "unsub": "MessageEvent",
 *     "reject": "MessageEvent",
 *     "spam": "MessageEvent",
 *     "open": "MessageEvent",
 *     "click": "MessageEvent",
 *     "send": "MessageEvent",
 *     "deferral": "MessageEvent",
 * })
 */
class AbstractEvent extends Event
{
    /**
     * @var string The type of event
     * @Serializer\SerializedName("event")
     * @Serializer\Type("string")
     */
    protected $type;

    /**
     * @var \DateTime The time of the event
     * @Serializer\SerializedName("ts")
     * @Serializer\Type("DateTime<'U'>")
     */
    protected $eventDate;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }
}
