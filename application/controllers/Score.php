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
	
		//file_put_contents("score.json", json_encode($arr));
		foreach ($arr as $b)
		{
			echo $b['name']." score=".$b['score']."<br />";
		}
	}

	public function setScore()
	{
		$score = $this->input->post('score',true);
		$pen_name = $this->input->post('pen_name',true);
		$data = array('name' => $pen_name, 'score' => $score);
		$scores = $this->getScores();//array of scores
		array_push($scores,$data);
		$this->load->model('score_model');
		$this->score_model->saveFile($scores);
		redirect('score/results');
	}

	public function results()
	{
		$data['scores'] = $this->getScores();
		$this->load->view('modal_results',$data);
	}

	/**
	 * Return an array with scores
	**/
	private function getScores()
	{
		$this->load->model('score_model');
		$arr = $this->score_model->getScores();
		return $arr;
	}
}

