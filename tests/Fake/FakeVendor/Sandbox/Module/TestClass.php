<?php

namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\FakeClass;
use Ray\FakeModule\Annotation\FakeMethod;

/**
 * @FakeClass(class="Fake\TestClass")
 */
class TestClass {

    /**
     * @FakeMethod
     */
    public function output() {
        return  "test class output";
    }
}