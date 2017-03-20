<?php

/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 20/03/2017
 * Time: 13:06
 */

namespace Fabs\DI;
class DI implements \ArrayAccess
{
    protected static $defaultInstance;

    protected $services = [];

    /**
     * @return DI
     */
    public static function getDefault()
    {
        if (self::$defaultInstance == null) {
            self::$defaultInstance = new DI();
        }
        return self::$defaultInstance;
    }

    public function set($service_name, $definition, $shared = false)
    {
        $service = new Service($service_name, $definition, $shared);
        $this->services[$service_name] = $service;
        return $service;
    }

    public function setShared($service_name, $definition)
    {
        return $this->set($service_name, $definition, true);
    }

    public function remove($service_name)
    {
        unset($this->services[$service_name]);
    }

    /**
     * @param $service_name
     * @return Service
     * @throws \Exception
     */
    public function getService($service_name)
    {
        if (isset($this->services[$service_name])) {
            return $this->services[$service_name];
        }
        throw new \Exception("Service '" . $service_name . "' wasn't found in the dependency injection container");
    }

    public function get($service_name)
    {
        return $this->getService($service_name)->resolve();
    }

    public function has($service_name)
    {
        return isset($this->services[$service_name]);
    }

    public function offsetExists($service_name)
    {
        return $this->has($service_name);
    }

    public function offsetGet($service_name)
    {
        return $this->get($service_name);
    }

    public function offsetSet($service_name, $definition)
    {
        $this->setShared($service_name, $definition);
        return true;
    }

    public function offsetUnset($offset)
    {
        return false;
    }
}