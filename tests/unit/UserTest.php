<?php

namespace App\Tests\unit;

use App\Entity\Users;

class UserTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $user = new Users();
        $user->setFirstName('Michel');
        $this->assertEquals('Michel', $user->getFirstName());
    }
}