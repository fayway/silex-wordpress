<?php

namespace SilexProof;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Bridge\Twig\TwigEngine;

class SettingsProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * 
     * @var TwigEngine
     */
    protected $twig;

    public function register(Container $app)
    {
        $this->twig = $app['twig'];
        
        $app['settings_provider'] = function (Container $app) {
            $app['logger']->debug('SettingPageProvider called');

            return $this;
        };

        $app['settings_provider.listener'] = function (Container $app) {
            return new SettingsSubscriber($app);
        };
    }

    public function boot(Application $app)
    {
        if (isset($app['settings_provider.listener'])) {
            $app['dispatcher']->addSubscriber($app['settings_provider.listener']);
        }
    }

    public function registerPage()
    {
        add_submenu_page('index.php', 'Silex Proof', 'Silex Proof', 'manage_options', 'silex-proof', array($this, 'echo_render'));
    }

    public function echo_render()
    {
        echo $this->render();
    }

    public function render()
    {
        return $this->twig->render('settings.html.twig', array(
            'name' => 'Silex Proof',
        ));
    }
}
