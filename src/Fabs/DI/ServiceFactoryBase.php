<?php

namespace Fabs\DI;

abstract class ServiceFactoryBase extends Injectable
{
    public abstract function create($parameters = []);
}
