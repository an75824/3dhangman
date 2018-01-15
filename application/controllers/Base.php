<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	public function __construct()
        {       
                parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');

        }

	public function index()
	{
		$data['title'] = 'Home Page';
		$this->load->view('header',$data);
		$this->load->view('home_page');
		$this->load->view('footer');
	}

	public function firstTry()
	{
		$this->load->model('word_model');
		$arr = $this->word_model->getWords();
		$w = $arr[4]['word']; // this will be the word from json
		$c = str_split($w); //create an array out of the word
		$d = ['r']; // this will be the user input

		foreach ($c as $char) //This will be the core of the game
		{
			if (in_array($char, $d))
			{
				echo $char;
			} else {
				echo "_ ";
			}
		}
	}//end of method
}

