<?php
namespace FakeVendor\Sandbox\Resource\App;

use BEAR\Resource\ResourceObject;
use Ray\FakeContextParam\Annotation\Fake;

class User extends ResourceObject
{
    public $uri = 'dummy://self/User';
    public $headers = [
        'x-header-test' => '123'
    ];
    private $users = [
        ['id' => 1, 'name' => 'Athos', 'age' => 15, 'blog_id' => 11],
        ['id' => 2, 'name' => 'Aramis', 'age' => 16, 'blog_id' => 12],
        ['id' => 3, 'name' => 'Porthos', 'age' => 17, 'blog_id' => 0]
    ];

    /**
     * @Fake(uri="app://self/fake/user")
     */
    public function onGet($id)
    {
        if (!isset($this->users[$id])) {
            throw new \InvalidArgumentException($id);
        }
        return $this->users[$id];
    }
}