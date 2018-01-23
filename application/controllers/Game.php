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
			'wrong_attempt' => 0,
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
		if (strlen($char_choice)!=1)
		{
			return false; //This method must only accept one character
		}

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
				$_SESSION['wrong_attempt']++;
				$_SESSION['round']++;
				$_SESSION['img']++;
				$data['word_input'] = $word;
				$this->load->view('game_result',$data);
			}
		} 
		if ($attempt == MAX_TRIES)
		{
			if ($word == $_SESSION['word'])
			{
				$_SESSION['result'] = $word;
				$_SESSION['full_input'] = TRUE;
			}
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
		$img_num = $_SESSION['img'];
		if ($img_num == 0 )
		{
			$data['msg'] = 'flawless victory! No errors!';
		} elseif($img_num>1 && $img_num<=5) {
			$data['msg'] = 'You need to try harder!';
		}else {
			$data['msg'] = 'Nice try!';
		}
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

	
	private function getWrongAttempts()
	{
		$user_choice = $_SESSION['user_choice'];
		$word = str_split($_SESSION['word']);
		$differences = array_diff($user_choice, $word);
		$_SESSION['wrong_attempt'] += sizeof($differences);
	}//end of getAttemptsStatus

	/**
	 * Calculate the score for the player.
	 * The length of the word gives extra points as well as the less rounds.
	**/
	private function calculateScore()
	{
		$round = $_SESSION['round'];
		$word_length = strlen($_SESSION['word']); //the word we are looking for
		$current_result = $_SESSION['result'];
		$user_choice = $_SESSION['user_choice'];
		$pure_str = str_replace("_","",$current_result);
		$str_length = strlen($pure_str);
		$wrong_attempt = $_SESSION['wrong_attempt'];
		$wrong_attemp = ($wrong_attempt >= 6) ? 5 : ''; //if worng attempt goes above 5 then make sure if will be five
		if ($str_length == 0)
		{
			$score = 0;
		} else {
			$wrong_attempts = $this->getWrongAttempts();
			$full_input = (isset($_SESSION['full_input'])) ? 50 : 0; //The right full word will give 50 points
			$score = 20 * $word_length - (10 * $round) + $full_input + (10 * $str_length) - (5*$wrong_attempts);
		}
		return $score;
	}
}//end of class

