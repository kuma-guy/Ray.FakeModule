<?php

namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\Fakeable;

/**
 * @Fakeable
 */
class TestClass
{
    public function output() {
        return  "test class output";
    }
}