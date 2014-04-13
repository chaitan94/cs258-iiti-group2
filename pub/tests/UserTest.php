<?php
include_once('models/users.php');
class UserTest extends PHPUnit_Framework_TestCase{
    public function testPushAndPop(){
    	$user = new User();
        $this->assertEquals(0, $user->id);
    }
}
?>