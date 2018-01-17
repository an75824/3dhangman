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

	/**
	 * If javascript is not enabled redirect to the error page
	**/
	public function noJs()
	{
		$this->load->view('errors/html/error_nojs');
	}

}

