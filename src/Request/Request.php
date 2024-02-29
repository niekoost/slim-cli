<?php

namespace niekoost\cli\Request;

use  Slim\Psr7\Environment;
use  Slim\Psr7\Request;

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

        return \Slim\Psr7\Request::createFromEnvironment($mockEnvironment);
    }
}
