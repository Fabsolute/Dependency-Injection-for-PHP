<?php
/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 21/03/2017
 * Time: 09:09
 */

require_once '../src/Fabs/DI/DI.php';
require_once '../src/Fabs/DI/Injectable.php';
require_once '../src/Fabs/DI/Service.php';

require_once 'MathService.php';
require_once 'CalculatorService.php';
require_once 'AnotherService.php';

use Fabs\DI\DI;

$di = DI::getDefault();
$di->setShared('mathService', MathService::class);
$di->set('calculator', function () {
    $calculator = new CalculatorService();
    return $calculator;
});

$di->set('another_service', 'AnotherService')
    ->setParameters([7, 8]);


$di->set('another_custom_service', 'AnotherService')->setParameters([4, 5]);

/** @var CalculatorService $calculator */
$calculator = $di->get('calculator');

$calculator->setNumber1(5);
$calculator->setNumber2(3);

echo $calculator->add();
echo '<br>';
echo $calculator->multiply();
echo '<br>';

/** @var AnotherService $another */
$another = $di['another_service'];

echo $another->calculate();

$another_service = $di->getService('another_service');

$another_service->setDefinition(function () {
    $math = new MathService();
    return $math;
});

/** @var MathService $overrided_another */
$overrided_another = $di['another_service'];

echo '<br>';
echo $overrided_another->add(9, 4);

echo '<br>';
/** @var AnotherService $another_custom_service */
$another_custom_service = $di->get('another_custom_service');
echo $another_custom_service->calculate();

echo '<br>';
/** @var AnotherService $another_custom_service_with_parameter */
$another_custom_service_with_parameter = $di->get('another_custom_service', [5, 9]);
echo $another_custom_service_with_parameter->calculate();