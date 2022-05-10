<?php

if (false === function_exists('pd')) {
    function pd($input = null, $detailed = true) {
        if ($detailed) {
            $debug = debug_backtrace()[0];
            $input = [$debug['file'], $debug['line'], $input];
        }

        echo '<pre>' . print_r($input, 1) . '</pre>';
        die();
    }
}

if (false === function_exists('conf')) {
    function conf($name = null, $required = []) {
        if (true === is_null($name)) {
            throw new \Exception("Config name cannot be empty");
        }

        $configFile = __DIR__ . '/../../../configs/' . $name . '.json';
        $configFile = realpath($configFile);

        if (false === $configFile) {
            throw new \Exception('Config file "' . $name . '" not found!', false);
        }

        $config = file_get_contents($configFile);
        $config = json_decode($config);

        if (null === $config) {
            throw new \Exception('Invalid JSON format for config file "' . $name . '"!', false);
        }

        unset($name, $configFile);

        if (0 < count($required)) {
            foreach ($required as $property) {
                if (false === property_exists($config, $property)) {
                    throw new \Exception('Missing property "' . $property . '" in config file');
                }
            }
        }

        return $config;
    }
}