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

    private $number_1;
    private $number_2;

    public function __construct($number_1, $number_2)
    {
        $this->number_1 = $number_1;
        $this->number_2 = $number_2;
    }

    public function calculate()
    {
        $this->calculator->setNumber1($this->number_1);
        $this->calculator->setNumber2($this->number_2);

        return $this->calculator->multiply();
    }

    public function setCalculatorService($calculator)
    {
        $this->calculator = $calculator;
    }
}