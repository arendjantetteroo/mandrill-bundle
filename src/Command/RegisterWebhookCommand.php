<?php

namespace Shareworks\Bundle\MandrillBundle\Command;

use Shareworks\Bundle\MandrillBundle\EventDispatcher\MessageEvent;
use Shareworks\Component\Mandrill\Webhook\Webhook;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Console command for registering the webhook endpoint with Mandrill.
 *
 * @author Raymond Jelierse <raymond@shareworks.nl>
 */
class RegisterWebhookCommand extends ContainerAwareCommand
{
    private $defaultEvents = [
        MessageEvent::HARD_BOUNCE,
        MessageEvent::SOFT_BOUNCE,
        MessageEvent::SPAM,
        MessageEvent::UNSUBSCRIBE,
        MessageEvent::REJECT,
    ];

    protected function configure()
    {
        $this
            ->setName('mandrill:webhook:register')
            ->setDescription('Register the webhook endpoint with Mandrill.')
            ->addOption('url', 'u', InputOption::VALUE_REQUIRED, 'The URL to register.')
            ->addOption('description', 'd', InputOption::VALUE_REQUIRED, 'The description to add to the webhook definition.')
            ->addArgument('events', InputArgument::IS_ARRAY, 'The events for which to register the webhook.', $this->defaultEvents);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getOption('url') ?: $this->getWebhookUrl();
        $events = $input->getArgument('events');
        $description = $input->getOption('description');

        $output->writeln(sprintf('Registering <info>%s</info> with Mandrill... ', $url));

        if ($output->getVerbosity() === OutputInterface::VERBOSITY_VERBOSE) {
            $output->writeln(sprintf('Listening to the following events: <comment>%s</comment>', implode('</comment>, <comment>', $events)));
        }

        $webhook = $this->registerWebhook($url, $description, $events);
        $output->writeln(sprintf('Webhook registered with id <info>%d</info>', $webhook->getId()));
    }

    /**
     * Get the default webhook URL.
     *
     * @return string
     */
    private function getWebhookUrl()
    {
        return $this->getContainer()
            ->get('router')
            ->generate('mandrill_webhook', [], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * Register the webhook.
     *
     * @param string $url
     * @param string $description
     * @param array  $events
     *
     * @return Webhook
     */
    private function registerWebhook($url, $description, array $events)
    {
        return $this->getContainer()
            ->get('mandrill.webhooks')
            ->register($url, $events, $description);
    }
}
