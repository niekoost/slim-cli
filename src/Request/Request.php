<?php

namespace niekoost\cli\Request;

use Psr\Http\Message\UriInterface;
use  Slim\Psr7\Environment;
use Slim\Psr7\Factory\UriFactory;
use  Slim\Psr7\Request as SlimRequest;

class Request implements RequestInterface
{
    private $supportedMethods = [
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH',
    ];

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMethodSupported($method)
    {
        return in_array(strtoupper($method), $this->supportedMethods, true);
    }

    /**
     * @param array $environmentProperties
     *
     * @return \Slim\Psr7\Request
     */
    public function getMockRequest($environmentProperties)
    {
        /** @var Environment $mockEnvironment */
        $mockEnvironment = Environment::mock($environmentProperties);
        
        $uriFactory = new UriFactory();
        $uri = $uriFactory->createUri($mockEnvironment['REQUEST_URI']);

        $headers = new \Slim\Psr7\Headers();
        $cookies = [];
        $serverParams = [];

        $context = stream_context_create([]);
        
        $body = new \Slim\Psr7\Stream($context);
        // @hack We only use method and uri. Headers and other parameters are ignored
        $request = new SlimRequest($mockEnvironment['REQUEST_METHOD'], $uri, $headers, $cookies, $serverParams, $body);

        return $request;
        
        // ::createFromEnvironment($mockEnvironment);
    }
}
