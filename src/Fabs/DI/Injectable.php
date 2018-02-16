<?php


namespace Fabs\DI;

abstract class Injectable
{
    /**
     * @var Container
     */
    private $container = null;

    /**
     * @param Container $dependency_injector
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function setContainer($dependency_injector)
    {
        $this->container = $dependency_injector;
    }

    /**
     * @return Container
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $name
     * @return mixed
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function __get($name)
    {
        $dependency_injector = $this->getContainer();
        if ($dependency_injector !== null && $dependency_injector->has($name)) {
            $this->{$name} = $dependency_injector->get($name);
        }

        return $this->{$name};
    }
}
