<?php

namespace niekoost\cli\Request;

interface RequestInterface
{
    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMethodSupported($method);

    /**
     * @param array $environmentProperties
     *
     * @return \Slim\Http\Request
     */
    public function getMockRequest($environmentProperties);
}
