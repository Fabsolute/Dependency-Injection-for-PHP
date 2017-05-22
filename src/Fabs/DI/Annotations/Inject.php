<?php
/**
 * Created by PhpStorm.
 * User: ahmetturk
 * Date: 22/05/2017
 * Time: 10:18
 */

namespace Fabs\DI\Annotations;


use Doctrine\Common\Annotations\Annotation;
/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class Inject extends Annotation{}