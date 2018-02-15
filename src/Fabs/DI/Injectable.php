<?php


namespace Fabs\DI;

abstract class Injectable
{
    /**
     * @var DI
     */
    private $dependency_injector = null;

    /**
     * @param DI $dependency_injector
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function setDI($dependency_injector)
    {
        $this->dependency_injector = $dependency_injector;
    }

    /**
     * @return DI
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function getDI()
    {
        if (!is_object($this->dependency_injector)) {
            $this->dependency_injector = DI::getDefault();
        }
        return $this->dependency_injector;
    }

    /**
     * @param string $name
     * @return mixed
     * @author ahmetturk <ahmetturk93@gmail.com>
     */
    public function __get($name)
    {
        $dependency_injector = $this->getDI();
        if ($dependency_injector->has($name)) {
            $this->{$name} = $dependency_injector->get($name);
        }

        return $this->{$name};
    }
}
