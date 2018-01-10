<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {
	public function __construct()
        {       
                parent::__construct();
		$this->load->helper('url');
        }

	public function index()
	{
		$data['title'] = 'Play Hangman';
		$this->load->view('header',$data);
		$this->load->view('play_game');
		$this->load->view('footer');
	}
}

