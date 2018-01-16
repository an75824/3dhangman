<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller {
	public function __construct()
        {       
                parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        }

	public function index()
	{

		$this->load->model('score_model');
		$arr = $this->score_model->getScores();
		$new_data['name'] = "Test";
		$new_data['score'] = "4321";
		array_push($arr,$new_data);
		file_put_contents("score.json", json_encode($arr));
		foreach ($arr as $b)
		{
			echo $b['name']." score=".$b['score']."<br />";
		}

	}
}

