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
		$json = read_file(SCORES_FILE);
		$arr = json_decode($json,true); //true will return an array
		return $arr;
	}//end of method

	/**
	 * Save the new data into the file
	 * @scores The array that contains name, score and date
	**/
	public function saveFile($scores)
	{
		//use file_put_con because we are going to write only once so, no efficiency issues.
		file_put_contents(SCORES_FILE, json_encode($scores));
	}
}//end of class

