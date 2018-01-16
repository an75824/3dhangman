<?php
class Score_model extends CI_Model {

	public function __construct()
        {
                parent::__construct();
		$this->load->helper('file');
        }

	/**
	 * Returns an array with the saved  scores
	**/
	public function getScores()
	{
		$json = read_file('score.json');
		$arr = json_decode($json,true); //true will return an array
		return $arr;
	}//end of method
}//end of class
