<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct()
        {       
                parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url','form'));
        }

	public function index()
	{
		$words['hang_word'] = $this->loadWord();
		$session_data = array(
			'word' => $words['hang_word']['word'],
			'user_choice' => array()
		); //create some session data
		$this->session->set_userdata($session_data); //store session data
		$data['title'] = 'Play Hangman';
		$_SESSION['test'] = array();
		$this->load->view('header',$data);
		$this->load->view('play_game',$words);
		$this->load->view('footer');
	}

	public function userChoice()
	{
		$this->load->view('test');
		$char_choice = $this->input->post('choice');
		array_push($_SESSION['user_choice'],$char_choice); //add character to session
	}

	/**
	 * Get the words and the description from the model
	**/
	private function loadWord()
	{
		$this->load->model('word_model');
		$arr = $this->word_model->getWords();
		$num2 = sizeof($arr);//take the size of the array as the upper limit
		$wordIndex = rand(0,$num2-1); //return me an index between 0 and num2-1 (because of array index)
		return $arr[$wordIndex]; //return a single word with the description
	}
}

