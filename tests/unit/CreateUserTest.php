<?php


namespace Unit;

use app\models\User;
use \UnitTester;

class CreateUserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    function testCreateUser(){
        $user = new User();
        $user->login = 'gg';
        $user->password = '123';
        $user->save();


        $this->assertEquals(true,$this->count(User::find()->where(['login'=>'gg'])->asArray()) == 1 ? true : false);
    }
}
