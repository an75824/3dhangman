<?php

class Word_model_test extends TestCase
{
	public function setup()
	{
		$this->json_array = $this->newModel('Word_model');
	}

	public function test_getWords_success()
	{
		$expected = array( 
			0 => array('word' => '3dhubs'),
			1 => array('word' => 'marvin'),
			2 => array('word' => 'print'),
			3 => array('word' => 'filament'),
			4 => array('word' => 'order'),
			5 => array('word' => 'layer')
		); //expected array list of words

		$words = $this->json_array->getWords(); //declare an array of words from the datastore
		foreach($words as $i => $w)
		{
			$this->assertEquals($expected[$i]['word'], $w['word']); //compare them
		}
	}		
}//end of class
