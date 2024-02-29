<?php

namespace niekoost\cli\Environment;

interface EnvironmentPropertiesInterface
{
    /**
     * @param array $args
     *
     * @return array
     */
    public function getProperties(array $args = []);
}
