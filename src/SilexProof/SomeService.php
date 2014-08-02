<?php
namespace SilexProof;

use Silex\Api\BootableProviderInterface;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SomeService implements ServiceProviderInterface 
{
    /* @var $this->request Symfony\Component\HttpFoundation\Request */
    protected $request;
    
    public function register(Container $app)
    {
        $this->request = $app['request']; 
        
        $app['some_service'] = function (Container $app)
        {
            return $this;
        };
    
    }
    
    public function sayHello()
    {
        $response = new JsonResponse('No Woman no cry : '. $this->request->get('data'));
        echo $response->getContent();
        die();
    }
}