<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	/*
		Function: Default Constructor
		Description: Default Constructor
	*/
	public function __construct(){
		parent::__construct();
	}


	/*
		Function: Index Function
		Description: Showscases Admin Dashboard
	*/
	public function index(){
		$data['title'] = 'SimpleIgniter | Home';
		$this->load->template('home', $data);
	}


}
