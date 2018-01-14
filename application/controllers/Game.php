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
			'round' => 0,
			'result' => '',
			'user_choice' => array()
		); //create some session data
		$this->session->set_userdata($session_data); //store session data
		$data['title'] = 'Play Hangman';
		$this->load->view('header',$data);
		$this->load->view('play_game',$words);
		$this->load->view('footer');
	}

	public function userChoice()
	{
		$char_choice = strtolower($this->input->post('choice'));

		if ($this->storeChar($char_choice))
		{
			if ($this->roundCount(false) <= MAX_TRIES)
			{
				error_log("OK smaller: ".$_SESSION['round'],0);
			} else {
				error_log("Limit exceeded: ". $_SESSION['round'],0);
			}
			$this->getInput(); //store the last structure of the word
			$this->load->view('game_result');
		} else {
			$data['duplicate_char'] = $char_choice;
			$this->load->view('game_result',$data);
		}
		if ($this->roundCount(false) == MAX_TRIES)
			{
				#redirect('game/end_of_game');
				error_log("OK die now unless its the right guess!",0);
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
			//$this->roundCount(true);
			//$this->calculateScore();
			return true;
		}
		if (in_array($char,$storedChars))
		{	
			return false; //do not record duplicated input - not fair to lose because of this!
		} else {
			array_push($_SESSION['user_choice'],$char);
			//$this->roundCount(true);
			//$this->calculateScore();
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
		$_SESSION['result'] = $result; //update the session variable
		$_SESSION['round']++;
		return $result;
	}//end of method

	/**
	 * Calculate the score for the player.
	 * The length of the word gives extra points as well as the less rounds.
	**/
	private function calculateScore($right_guess = 0)
	{
		$round = $_SESSION['round'];
		$word_length = $_SESSION['word'];
		$full_input = (isset($_SESSION['full_input'])) ? $_SESSION['full_input'] : 0; //full word input
		$score = 100 * $word_length - (30 * $round) + $full_input + $right_guess;
		return $score;
	}
}//end of class

