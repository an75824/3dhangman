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
		$word = $words['hang_word']['word'];
		$first_str = '';
		for ($i = 0; $i<strlen($word); $i++)
		{
			$first_str .= '_ ';
		}
		$words['first_str'] = $first_str;

		$session_data = array(
			'word' => $word,
			'user_choice' => array(),
			'stored_chars' => array() //not needed
		); //create some session data
		$this->session->set_userdata($session_data); //store session data
		$data['title'] = 'Play Hangman';
		$this->load->view('header',$data);
		$this->load->view('play_game',$words);
		$this->load->view('footer');
	}

	public function userChoice()
	{
		//$this->load->view('test');
		$char_choice = $this->input->post('choice');

		if ($this->storeChar($char_choice))
		{
			$this->getInput(); //store the last structure of the word
			$this->load->view('game_result');
		} else {
			$data['duplicate_char'] = $char_choice;
			$this->load->view('game_result',$data);
			//error_log("Duplicated char! $char_choice",0);
		}
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

	private function storeChar($char)
	{
		$storedChars = $_SESSION['user_choice'];
		
		if (sizeof($storedChars) == 0)
		{
			array_push($_SESSION['user_choice'],$char);
			return true;
		}
		if (in_array($char,$storedChars))
		{	
			return false; //duplicated input - not fair to lose because of this!
		} else {
			array_push($_SESSION['user_choice'],$char);
			return true;
		}
	}//end of method

	private function getInput()
	{
		$chars_word = str_split($_SESSION['word']); //create array of chars from the word
		$chars_user = $_SESSION['user_choice'];
		$result = '';
		foreach($chars_word as $c)
		{
			if (in_array($c, $chars_user))
			{
				$result .=  $c;
			} else {
				$result .= '_';
			}//end if
		}//end foreach
		$_SESSION['result'] = $result;
		return $result;
	}//end of method
}

