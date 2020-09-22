<?php

namespace App\Tests\unit;

use Codeception\Test\Unit;
use App\Entity\Users;

class UserTest extends Unit
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