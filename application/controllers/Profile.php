<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{


	/*
			Function: Default Constructor
			Description: Default Constructor
	*/
	public function __construct(){
		parent::__construct();

		$userID = $this->session->userdata('userID');
		# Verifies User IS Logged In
		if (!$userID){
			redirect('users/login');
		}
	}


	/*
			Function: Index Function
			Description: Redirects to profile/edit
	*/
	public function index(){
		redirect('profile/edit');
	}


	# Edit Profile Function
	/*
			Function: Edit Profile
			Description: Allows The User To Edit Their Profile Information
	*/
	public function edit(){
		$data['title']    = 'Profile | Edit';
		$data['userData'] = $this->session->userdata();

		# If POST Form was Submitted
		if (!empty($_POST)){
			# Inserts userID into $_POST array
			$_POST['userID'] = $data['userData']['userID'];

			# Runs Form Validation in config/form_validation.php
			$editValidation = $this->form_validation->run();

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

				# UPDATES New User Data into 'users' table for $userID
				$userChange = $this->user_model->userEdit($_POST);

				# If $userChange returns TRUE
				if ($userChange){
					$this->session->set_userdata(array(
						'userFirstName' => $_POST['userFirstName'],
						'userLastName'  => $_POST['userLastName'],
						'userEmail'     => $_POST['userEmail']
					));

					# Flashes SUCCESS Information Message
					$this->session->set_flashdata('success', 'You have successfully updated your information.');
					redirect();
				}
				# If $userChange returns FALSE
				else {
					# Flashes DANGER Information Message
					$this->session->set_flashdata('danger', 'Something has happened internally. Please try again.');
					$this->load->template('profile/edit', $data);
				}

			}
			# If $editValidation returns FALSE
			else {
				$this->load->template('profile/edit', $data);
			}
		}
		# If POST Form was NOT Submitted
		else {
			$this->load->template('profile/edit', $data);
		}
	}


	/*
			Function: User Logout
			Description: Logs The Current User Out Of Their Account
	*/
	public function logout(){
		$userID = $this->session->userdata('userID');
		# Verifies The User is Logged In
		if (!$userID){
			#If The User is NOT Logged In
			redirect('users/login');
		}
		else {
			# DESTROYS the current SESSION Values
			$this->session->sess_destroy();
			redirect();
		}
	}
}
