<?php
use Fabs\DI\Injectable;

/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 21/03/2017
 * Time: 09:42
 */
class AnotherService extends Injectable
{
    /** @var  CalculatorService */
    protected $calculator;

    public function calculate()
    {
        $this->calculator->setNumber1(4);
        $this->calculator->setNumber2(5);

        return $this->calculator->multiply();
    }

    public function setCalculatorService($calculator)
    {
        $this->calculator = $calculator;
    }
}