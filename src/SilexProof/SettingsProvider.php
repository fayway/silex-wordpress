<?php

namespace SilexProof;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

class SettingsProvider implements ServiceProviderInterface, BootableProviderInterface 
{

    protected $twig;
    
	public function register(Container $app)
	{
	    
		$app['settings_provider'] = function (Container $app) 
		{
		    $this->twig = $app['twig'];
			$app['logger']->addDebug('SettingPageProvider called', array($app['twig']));
			return $this;
		};
		
		$app['settings_provider.listener'] = function(Container $app) 
		{
			return new SettingsSubscriber($app);
		};
	}
	
	public function boot(Application $app)
	{
		if (isset($app['settings_provider.listener'])) 
		{
			$app['dispatcher']->addSubscriber($app['settings_provider.listener']);
		}
	}

	public function register_page() 
	{
		add_submenu_page( 'index.php', 'Silex Proof', 'Silex Proof', 'manage_options', 'silex-proof', array($this, 'echo_render') );
	}

	public function echo_render() 
	{
		echo $this->render();
	}
	
	public function render() 
	{
	    /*
		ob_start();
		?>
		<div class="wrap">
			<h2>Plugin Configuration</h2>
		</div>
		<?php
		$content = ob_get_clean();
		return $content;
	    */
	    return $this->twig->render('settings.html.twig', array(
	        'name' => 'Silex Proof',
	    ));
	}

}