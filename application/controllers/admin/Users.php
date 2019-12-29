<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends CI_Controller {


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
			Description: Showscases Admin User Dashboard
		*/
		public function index(){
			$data['userData'] = $this->session->userdata();
			$data['title']    = 'Admin | Home';
			$this->load->template('admin/users/home', $data);
		}


		/*
			Function: List of Users
			Description: Showcases ALL the Registered Users
		*/
		public function list(){
			$data['userData'] = $this->session->userdata();
			$data['title']    = 'Admin | List of Users';
			$data['userList'] = $this->admin_model->getUsers();
			$this->load->template('admin/users/list', $data);
		}


		/*
			Function: Email User
			Description: Allows Admin To Email User
			Inputs: userID
		*/
		public function email($userID){
			$data['userData']  = $this->session->userdata();
			$data['title']     = 'Admin | Email User: #'.$userID;

			# Attempts to Get User Information To Ready Email Form
			$data['emailInfo'] = $this->admin_model->getUsers($userID);

			# If $userID is Linked to an Account
			if (!empty($data['emailInfo'])){
				# Makes $emailInfo maleable
				$data['emailInfo'] = (array) $data['emailInfo'][0];

				# If POST Form was Submitted
				if (!empty($_POST)){
					# Load in The EMAIL Library
					$this->load->library('email');

					$this->email->from('no-reply@simpleigniter.com', 'The Admin Team');
					$this->email->to($data['emailInfo']['userEmail']);
					$this->email->subject($_POST['emailSubject']);
					$this->email->message($_POST['emailBody']);

					# If Email Sends Successfully
					if ($this->email->send()){
						$this->session->set_flashdata('success', 'You have successfully sent an email to User: #'.$userID);
						redirect('admin/users/list');
					}
					# If Email Send Attempt FAILS
					else {
						# Flashes DANGER Information Message
						$this->session->set_flashdata('danger', 'Something has happened internally. Please try again.');
						$this->load->template('admin/users/email', $data);
					}
				}
				# If POST Form was NOT Submitted
				else {
					$this->load->template('admin/users/email', $data);
				}
			}
			# If $userID is NOT Linked to an Account
			else {
				# Flashes DANGER Information Message
				$this->session->set_flashdata('danger', 'The given User ID was not valid.');
				redirect('admin/users/list');
			}
		}


		/*
			Function: Edit User
			Description: Allows Admin To Edit User's Information
			Inputs: userID
		*/
		public function edit($userID){
			$data['userData'] = $this->session->userdata();
			$data['title']    = "Admin | Edit User: #{$userID}";

			# Attempts to Get User Information To Ready Edit Form
			$data['editUserInfo'] = $this->admin_model->getUsers($userID);

			# If $userID is Linked to an Account
			if (!empty($data['editUserInfo'])){
				# Makes $editUserInfo maleable
				$data['editUserInfo'] = (array) $data['editUserInfo'][0];

				# If POST Form was Submitted
				if (!empty($_POST)){
					# DELETE Form was POSTed
					if (array_key_exists('delete', $_POST) && $_POST['delete'] == 'Y'){
						# Attempts to DELETE the Given User based on $userID
						$deleteCheck = $this->admin_model->deleteUser($data['editUserInfo']['userID']);

						# If $deleteCheck did Work
						if ($deleteCheck){
							# Flashes SUCCESS Information Message
							$this->session->set_flashdata('success', 'You have successfully delete the user: #'.$data['editUserInfo']['userID'].'.');
							redirect('admin/users/list');
						}
						# If $deleteCheck did NOT Work
						else {
							# Flashes DANGER Information Message
							$this->session->set_flashdata('danger', 'Internal error. Please try again.');
							$this->load->template('admin/users/edit', $data);
						}
					}
					# DELETE Form was not POSTed
					else {
						# Inserts userID into $_POST array
						$_POST['userID'] = $userID;

						# Runs Form Validation in config/form_validation.php
						$editValidation = $this->form_validation->run('admin/users/edit');

						# Checks if $editValidation returns TRUE
						if ($editValidation){
							# Checks if $userPassword is set (OPTIONAL)
							if ($_POST['userPassword'] == ''){
								unset($_POST['userPassword']);
							}
							else {
								$_POST['userPassword'] = $this->encryption->password_hash($_POST['userPassword']);
							}

							# UNSETS $userPasswordConfirm to avoid problems with updating 'users' table
							unset($_POST['userPasswordConfirm']);

							$userChange = $this->user_model->userEdit($_POST);
							# If $userChange returns TRUE
							if ($userChange){
								# Flashes SUCCESS Information Message
								$this->session->set_flashdata('success', 'You have successfully updated your information.');
								redirect('admin/users/list');
							}
							# If $userChange returns FALSE
							else {
								# Flashes DANGER Information Message
								$this->session->set_flashdata('danger', 'Something has happened internally. Please try again.');
								$this->load->template('admin/users/edit', $data);
							}
						}
						# If $editValidation returns FALSE
						else {
							$this->load->template('admin/users/edit', $data);
						}
					}
				}
				# If POST Form was NOT Submitted
				else {
					$this->load->template('admin/users/edit', $data);
				}

			}
			# If $userID is NOT Linked to an Account
			else {
				# Flashes DANGER Information Message
				$this->session->set_flashdata('danger', 'The given User ID was not valid.');
				redirect('admin/users/list');
			}

		}


    }
