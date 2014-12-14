<?php

namespace Shareworks\Bundle\MandrillBundle\EventDispatcher;

use JMS\Serializer\Annotation as Serializer;

class SyncEvent extends AbstractEvent
{
    const WHITELIST = 'whitelist';
    const BLACKLIST = 'blacklist';

    /**
     * @var string The action performed
     * @Serializer\Type("string")
     */
    protected $action;

    // TODO: Add reason for listing
}
