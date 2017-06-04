<?php
/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 20/03/2017
 * Time: 13:47
 */

namespace Fabs\DI;

abstract class Injectable
{
    private $dependency_injector;
    private $is_services_injected = false;

    public function setDI($dependency_injector)
    {
        $this->dependency_injector = $dependency_injector;
    }

    public function getDI()
    {
        if (!is_object($this->dependency_injector)) {
            $this->dependency_injector = DI::getDefault();
        }
        return $this->dependency_injector;
    }

    public function setServicesInjected($is_services_injected)
    {
        $this->is_services_injected = $is_services_injected;
    }

    public function isServicesInjected()
    {
        return $this->is_services_injected;
    }

    public function __get($name)
    {
        $di = $this->getDI();
        if ($name == 'di') {
            $this->{$name} = $di;
            return $di;
        }

        if ($di->has($name)) {
            $response = $di->get($name);
            $this->{$name} = $response;
            return $response;
        }

        return null;
    }
}