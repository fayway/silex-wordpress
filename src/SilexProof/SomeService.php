<?php
namespace SilexProof;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class SomeService implements ServiceProviderInterface
{
    /**
     *
     * @var Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     *
     * @var LoggerInterface
     */
    protected $logger;

    public function register(Container $app)
    {
        $this->request = $app['request'];
        $this->logger = $app['logger'];

        $app['some_service'] = function (Container $app) {
            return $this;
        };
    }

    public function sayHello()
    {
        $this->logger->debug(__METHOD__ . ' called');
        $response = new JsonResponse("To Silex or not to Silex, that's the question and the answer is: ".$this->request->get('data'));
        echo $response->getContent();
        die();
    }
}
