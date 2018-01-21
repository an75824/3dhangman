<?php

class Base_test extends TestCase {

	public function test_noJs()
	{
		$output = $this->request('Get',['Base', 'noJs']);
		$expected = '<h1>Problem with Javascript</h1>
		<p> Please make sure that you have Javascript enabled or use a newer browser.</p>';
		$expetcted = $this->assertContains($expected,$output);
	}

}//end of class
