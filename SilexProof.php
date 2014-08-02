<?php
/**
* Plugin Name: Silex Proof
* Description: Silex Proff of Concept as WordPress plugin
* Version: 1.0
* Author: .Fay Labs
*/
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use SilexProof\SettingsProvider;
use SilexProof\Events;
use SilexProof\SettingsEvent;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use SilexProof\SomeService;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application();
$app['debug'] = false;

$request = Request::createFromGlobals();
$app['request'] = $request;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/dev.log',
));
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new SettingsProvider());
$app->register(new SomeService());

//Just to get ride from an ugly exception in my pretty log
$app->match('/', function() use($app)
{
    return new Response();
});


//Manual app->run()
$app->handle($request);

//WP actions
add_action( 'wp_ajax_my_ajax', array($app['some_service'], 'sayHello'));
if (!$request->isXmlHttpRequest()){
    add_action('admin_menu', array($app['settings_provider'], 'register_page'));
    
    /* @var $dispatcher Symfony\Component\EventDispatcher\EventDispatcherInterface */
    $dispatcher = $app['dispatcher'];
    $dispatcher->dispatch(Events::SETTING_PAGE_RENDERED, new SettingsEvent('WP!!!!'));
}














