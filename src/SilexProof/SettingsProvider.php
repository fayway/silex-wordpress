<?php

namespace SilexProof;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

class SettingsProvider implements ServiceProviderInterface, BootableProviderInterface 
{

	public function register(Container $app)
	{
	    add_action('admin_menu', array($this, 'register_page'));
	    
		$app['settings_provider'] = function (Container $app) 
		{
			//$app['logger']->addDebug('SettingPageProvider called');
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
		ob_start();
		?>
		<div class="wrap">
			<h2>Plugin Configuration</h2>
		</div>
		<?php
		$content = ob_get_clean();
		return $content;
	}

}