<?php

namespace SilexProof;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Pimple\Container;

class SettingsSubscriber implements EventSubscriberInterface
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public static function getSubscribedEvents()
    {
        return array(
            Events::SETTING_PAGE_RENDERED => 'settingPageRendered'
        );
    }

    public function settingPageRendered(SettingsEvent $event)
    {
        $this->app['logger']->addInfo('Oh YEAH ! Setting Page Rendered YES !', array($event->getSource()));
    }
}