<?php

namespace Shareworks\Bundle\MandrillBundle\Controller;

use Shareworks\Bundle\MandrillBundle\EventDispatcher\AbstractEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for Mandrill Webhooks.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class WebhookController extends Controller
{
    /**
     * Incoming webhook action.
     *
     * The webhook is sent with a single POST field 'mandrill_events', which contains a JSON encoded array of events.
     *
     * @param Request $request The webhook request
     *
     * @return Response An empty response with status 200
     *
     * @link http://help.mandrill.com/entries/24466132-Webhook-Format
     */
    public function incomingAction(Request $request)
    {
        $events = $this->getEventsFromRequest($request);

        foreach ($events as $event) {
            $this->get('mandrill.event_dispatcher')->dispatch($event->getType(), $event);
        }

        return Response::create();
    }

    /**
     * Transform the JSON payload into an array of event instances.
     *
     * @param Request $request
     *
     * @return AbstractEvent[]
     */
    private function getEventsFromRequest(Request $request)
    {
        $events = $request->request->get('mandrill_events', '[]');
        $events = $this->get('jms_serializer.serializer')->deserialize($events, 'Shareworks\Component\Mandrill\Event\AbstractEvent', 'json');

        return $events;
    }
}
