<?php
class Word_model extends CI_Model {

	public function __construct()
        {
                parent::__construct();
		$this->load->helper('file');
        }

	/**
	 * Fetches data from the Json file
	**/
	public function getWords()
	{
		$json = read_file('words/words.json');
		$arr = json_decode($json,true); //true will return an array
		return $arr;
	}//end of method
}//end of class
