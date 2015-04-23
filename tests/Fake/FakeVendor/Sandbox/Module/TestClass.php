<?php

namespace FakeVendor\Sandbox\Module;

use Ray\FakeContextParam\Annotation\FakeClass;
use Ray\FakeContextParam\Annotation\FakeMethod;

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