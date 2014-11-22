<?php

namespace SilexProof;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Pimple\Container;

class SettingsSubscriber implements EventSubscriberInterface
{
    /**
     *
     * @var Pimple\Container
     */
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public static function getSubscribedEvents()
    {
        return array(
            Events::SETTING_PAGE_RENDERED => 'doOnSettingPageRender',
        );
    }

    public function doOnSettingPageRender(SettingsEvent $event)
    {
        $this->app['logger']->addInfo('Oh YEAH ! Setting Page Rendered YES !', array($event->getSource()));
    }
}
