<?php
use Fabs\DI\Annotations\Inject;

/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 22/05/2017
 * Time: 11:35
 */
class InjectionWithoutInjectable
{
    /**
     * @var CalculatorService
     * @Inject()
     */
    public $calculator;

    public function done($prefix)
    {
        $this->calculator->setNumber1(rand(0,5));
        $this->calculator->setNumber2(rand(0, 5));
        echo $prefix . ': ' . $this->calculator->multiply();
    }
}