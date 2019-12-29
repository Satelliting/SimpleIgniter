<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {


		/*
			Function: Default Constructor
			Description: Default Constructor
		*/
		public function __construct(){
			parent::__construct();
			$this->load->model('admin_model');

			# Verifies User IS Logged In
			$userID = $this->session->userdata('userID');
			if (!$userID){
				redirect('users/login');
			}

			# Verifies User HAS Admin Role
			$userRole = $this->session->userdata('userRole');
			if ($userRole != 100){
				redirect();
			}
		}


		/*
			Function: Index Function
			Description: Showscases Admin Dashboard
		*/
		public function index(){
			$data['userData'] = $this->session->userdata();
			$data['title']    = 'Admin | Home';
			$this->load->template('admin/home', $data);
		}


	}
