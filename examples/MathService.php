<?php
use Fabs\DI\Injectable;

/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 21/03/2017
 * Time: 09:11
 */
class MathService extends Injectable
{
    public function add($number1, $number2)
    {
        return $number1 + $number2;
    }

    public function multiply($number1, $number2)
    {
        return $number1 * $number2;
    }

    public function setAhmetService($service)
    {

    }
}