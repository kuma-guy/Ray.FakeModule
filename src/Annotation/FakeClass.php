<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class FakeClass extends AbstractFakeContextParam
{
    /**
     * @var string
     */
    public $class;
}
