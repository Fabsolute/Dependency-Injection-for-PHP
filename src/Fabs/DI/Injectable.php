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
}