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

require_once __DIR__.'/vendor/autoload.php';

$app = new Application();
$app['debug'] = false;

$app->register(new MonologServiceProvider(), array(
		'monolog.logfile' => __DIR__.'/dev.log',
));
$app->register(new SettingsProvider());

$app->match('/', function() use($app)
{
    return new Response();
});

$request = Request::createFromGlobals();
$response = $app->handle($request);


$app['dispatcher']->dispatch(Events::SETTING_PAGE_RENDERED, new SettingsEvent('WP'));











