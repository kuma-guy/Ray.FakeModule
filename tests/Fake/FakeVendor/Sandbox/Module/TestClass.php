<?php

namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\FakeClass;

/**
 * @FakeClass
 */
class TestClass
{
    public function output() {
        return  "test class output";
    }
}