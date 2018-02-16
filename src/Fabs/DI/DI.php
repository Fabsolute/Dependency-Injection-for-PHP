<?php


namespace Fabs\DI;


use Psr\Container\ContainerInterface;

class DI implements \ArrayAccess, ContainerInterface
{
    /** @var DI */
    private static $default_dependency_injector = null;
    /**
     * @var ServiceDefinition[]
     */
    protected $service_lookup = [];

    /**
     * @param DI $dependency_injector
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public static function setDefault($dependency_injector)
    {
        self::$default_dependency_injector = $dependency_injector;
    }

    /**
     * @param string $service_name
     * @param string|callable|mixed $definition
     * @param bool $shared
     * @param array $parameters
     * @return ServiceDefinition
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function set($service_name, $definition, $shared = false, $parameters = [])
    {
        $service_definition = new ServiceDefinition($service_name, $definition, $shared, $parameters);
        $this->service_lookup[$service_name] = $service_definition;
        return $service_definition;
    }

    /**
     * @param string $service_name
     * @param string|callable|mixed $definition
     * @param array $parameters
     * @return ServiceDefinition
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function setShared($service_name, $definition, $parameters = [])
    {
        return $this->set($service_name, $definition, true, $parameters);
    }

    /**
     * @param string $service_name
     * @return ServiceDefinition
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function getService($service_name)
    {
        if (array_key_exists($service_name, $this->service_lookup)) {
            return $this->service_lookup[$service_name];
        }

        return null;
    }

    /**
     * @param string $service_name
     * @return mixed|null
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function get($service_name)
    {
        $service = $this->getService($service_name);
        if ($service === null) {
            // todo throw
            return null;
        }

        return $this->resolve($service);
    }

    /**
     * @param ServiceDefinition $service
     * @return mixed|null
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    private function resolve($service)
    {
        $instance = $service->getInstance();

        if ($instance instanceof Injectable) {
            $instance->setContainer($this);
        }

        return $instance;
    }

    /**
     * @param string $service_name
     * @return bool
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function has($service_name)
    {
        return array_key_exists($service_name, $this->service_lookup);
    }

    /**
     * @param string $service_name
     * @return bool
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function offsetExists($service_name)
    {
        return $this->has($service_name);
    }

    /**
     * @param string $service_name
     * @return mixed|null
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function offsetGet($service_name)
    {
        return $this->get($service_name);
    }

    /**
     * @param string $service_name
     * @param string|callable|mixed $definition
     * @return bool
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function offsetSet($service_name, $definition)
    {
        $this->set($service_name, $definition, true);
        return true;
    }

    /**
     * @param string $service_name
     * @return bool
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function offsetUnset($service_name)
    {
        return false;
    }
}
