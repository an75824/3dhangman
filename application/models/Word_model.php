<?php
class Word_model extends CI_Model {

	public function getWords()
	{
		$json = read_file('words/words.json');
		$arr = json_decode($json,true);
		return $arr;
	}
}//end of class
