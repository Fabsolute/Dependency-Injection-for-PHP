<?php
use Fabs\DI\Injectable;

/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 21/03/2017
 * Time: 09:11
 */
class CalculatorService extends Injectable
{
    /**
     * @var MathService
     */
    protected $math_service;

    protected $number1;
    protected $number2;

    public function add()
    {
        return $this->math_service->add($this->number1, $this->number2);
    }

    public function multiply()
    {
        return $this->math_service->multiply($this->number1, $this->number2);
    }

    public function setNumber1($number1)
    {
        $this->number1 = $number1;
    }

    public function setNumber2($number2)
    {
        $this->number2 = $number2;
    }

    public function setMathService($math_service)
    {
        $this->math_service = $math_service;
    }
}