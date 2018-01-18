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
			'round' => 1,
			'result' => '',
			'img' => 0,
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
		$char_choice = strtolower($this->input->post('choice',TRUE));
		$attempt = $_SESSION['round'];

		if ($attempt <= MAX_TRIES )
		{		
			if ($this->storeChar($char_choice))
			{
				$this->getInput($char_choice); //store the last structure of the word
				$this->load->view('game_result');
			} else {
				$data['duplicate_char'] = $char_choice;
				$this->load->view('game_result',$data);
			}
		}//end if for attempt

		if ($this->checkResult())
		{
			redirect('game/game_over');
		}

		if ($attempt == MAX_TRIES)
		{
			redirect('game/game_over');
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
			$_SESSION['round']++;
			return true;
		}
		if (in_array($char,$storedChars))
		{	
			return false; //do not record duplicated input - not fair to lose because of this!
		} else {
			array_push($_SESSION['user_choice'],$char);
			$_SESSION['round']++;
			return true;
		} //end of if attempt
	}//end of method

	public function fullWord()
	{
		$word = strtolower($this->input->post('word',TRUE));
		$attempt = $_SESSION['round'];
		if ($attempt <= MAX_TRIES )
		{
			if ($word == $_SESSION['word'])
			{
				$_SESSION['result'] = $word; //update the session variable
				$_SESSION['full_input'] = TRUE;
				$this->game_over();
			} else {
				$_SESSION['round']++;
				$_SESSION['img']++;
				$data['word_input'] = $word;
				$this->load->view('game_result',$data);
			}
		} 
		if ($attempt == MAX_TRIES)
		{
			$_SESSION['result'] = $word;
			$_SESSION['full_input'] = TRUE;
			$this->game_over();
		}
	}
	
	public function game_over()
	{
		if (!$this->checkResult())
		{
			$_SESSION['img'] = 5;
		}
		$data['score'] = $this->calculateScore();
		$this->load->view('game_over',$data);
	}

	private function getInput()
	{
		$chars_word = str_split($_SESSION['word']); //create array of chars from the word
		$chars_user = $_SESSION['user_choice'];

		if (!in_array(end($chars_user),$chars_word))
		{
			$_SESSION['img']++; //if the input is wrong, increase the img number
		}

		$result = ''; //init the output
		/* Construct the output string  */
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
		if ($result == $_SESSION['word'])
		{	
			redirect('game/game_over');
		}
		return $result;
	}//end of method

	private function checkResult()
	{
		$current_input = $_SESSION['result'];
		$word = $_SESSION['word'];

		if ($current_input == $word)
		{
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Calculate the score for the player.
	 * The length of the word gives extra points as well as the less rounds.
	**/
	private function calculateScore()
	{
		$round = $_SESSION['round'];
		$word_length = strlen($_SESSION['word']); //the word we are looking for
		$current_result = $_SESSION['result'];
		$pure_str = str_replace("_","",$current_result);
		$str_length = strlen($pure_str);
		if ($str_length == 0)
		{
			$score = 0;
		} else {
			$full_input = (isset($_SESSION['full_input'])) ? 100 : 0; //The right full word will give 100 points
			$score = 100 * $word_length - (30 * $round) + $full_input + (10 * $str_length);
		}
		return $score;
	}
}//end of class

