<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

use BEAR\Resource\ResourceObject;
use Ray\FakeContextParam\Annotation\Fake;

class FakeUserResource extends ResourceObject
{
    public function onGet()
    {
        $this['fake'] = true;
        return $this;
    }
}
