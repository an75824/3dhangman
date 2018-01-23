<?php

class Base_test extends TestCase {

	public function test_userChoice_success()
	{
		$output = $this->request('POST','Game/userChoice',['choice'=>'a']);
		$expetcted = $this->assertContains('a',$output);//It can be any character
	}

	public function test_userChoice_fail()
	{
		$output = $this->request('POST','Game/userChoice',['choice'=>'hello']);
		$expetcted = $this->assertContains('h',$output); //it will also fail if 'h' is 'hello'
	}

}//end of class
