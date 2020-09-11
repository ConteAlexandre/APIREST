<?php
/*
 * Created at 9/11/20, 11:55 AM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Tests\Entity;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests\Entity
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class UserTest extends TestCase
{
    public function testFirstname()
    {
        $user = new Users();
        $firstName = 'Michel';

        $user->setFirstName($firstName);
        $this->assertEquals("Michel", $user->getFirstName());
    }
}