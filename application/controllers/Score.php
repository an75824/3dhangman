<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller {
	public function __construct()
        {       
                parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
        }

	public function highScores()
	{
		$data['title'] = 'High Scores!';
		$this->load->view('header',$data);
		$data['scores'] = $this->getScores();
		$this->load->view('modal_results',$data);
		$this->load->view('footer');
	}

	public function setScore()
	{
		$date_today = '%d/%M/%Y';
		$date_str = mdate($date_today);
		$score = $this->input->post('score',true);
		$pen_name = $this->input->post('pen_name',true);
		$data = array('name' => $pen_name, 'score' => $score, 'date' => $date_str);
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

