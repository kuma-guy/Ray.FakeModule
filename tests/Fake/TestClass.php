<?php

namespace Ray\FakeModule;

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