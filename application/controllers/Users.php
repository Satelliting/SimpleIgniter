<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends CI_Controller {


		/*
			Function: Default Constructor
			Description: Default Constructor
		*/
		public function __construct(){
			parent::__construct();

			$userID = $this->session->userdata('userID');
			# Verifies User is NOT Logged In
			if ($userID){
				redirect('profile');
			}
		}


		/*
			Function: User Registration
			Description: Handles The User Registration Process
			Inputs: First Name, Last Name, Email, Password, PasswordConfirm (POST Request)
		*/
		public function register(){
			$data['title'] = "User Registration";

			# Gets Input From Register POST Form
			$registerInfo = array(
				'userFirstName'       => $this->input->post('userFirstName'),
				'userLastName'        => $this->input->post('userLastName'),
				'userEmail'           => $this->input->post('userEmail'),
				'userPassword'        => $this->input->post('userPassword'),
				'userPasswordConfirm' => $this->input->post('userPasswordConfirm')
			);

			# If POST Form was Submitted
			if (!empty($_POST)){
				# Runs Form Validation in config/form_validation.php
				$registerValidation = $this->form_validation->run();

				# Checks if $registerValidation returns TRUE
				if ($registerValidation) {
					# Hashes $userPassword To The Most Encrypted Form Possible
					$registerInfo['userPassword'] = $this->encryption->password_hash($registerInfo['userPassword']);
					# UNSETS $userPasswordConfirm for Database INSERT
					unset($registerInfo['userPasswordConfirm']);

					# INSERTS New User Data into 'users' table
					$userRegistration = $this->user_model->userRegister($registerInfo);

					# If $userRegistration returns TRUE
					if ($userRegistration){
						# Flashes SUCCESS Information Message
						$this->session->set_flashdata('success', 'You have successfully registered. Feel free to now login to your account.');
						redirect('users/login');
					}
					# If $userRegistration returns FALSE
					else {
						# Flashes DANGER Information Message
						$this->session->set_flashdata('danger', 'Something has happened internally. Please try again.');
						$this->load->template('users/register', $data);
					}
				}
				# If $registerValidation returns FALSE
				else {
					$this->load->template('users/register', $data);
				}
			}
			# If POST Form was NOT Submitted
			else {
				$this->load->template('users/register', $data);
			}
		}


		/*
			Function: User Login
			Description: Handles The User Login Process
			Inputs: Email, Password (POST Request)
		*/
		public function login(){
			$data['title'] = "User Login";

			# Gets Input From Login POST Form
			$email    = $this->input->post('userEmail');
			$password = $this->encryption->password_hash($this->input->post('userPassword'));

			# If POST Form was Submitted
			if (!empty($_POST)){
				$loginUser = $this->user_model->userLogin($email, $password);

				# Verifies Login Credentials Are A Match
				if ($loginUser){
					# Gets User Information of Newly Logged In User
					$userInfo = (array) $loginUser[0];

					# Verifies User Was Not Banned
					if ($userInfo['userStatus'] != 0){
						# Sets SESSION Data for User
						$this->session->set_userdata(array(
							'userID'        => $userInfo['userID'],
							'userFirstName' => $userInfo['userFirstName'],
							'userLastName'  => $userInfo['userLastName'],
							'userEmail'     => $userInfo['userEmail'],
							'userRole'      => $userInfo['userRole']
						));

						# Flashes SUCCESS Information Message
						$this->session->set_flashdata('success', 'You have successfully logged in.');
						redirect();
					}
					# Displays Message To User for being BANNED/DEACTIVATED
					else {
						# Flashes DANGER Information Message
						$this->session->set_flashdata('danger', 'Your account is currently banned/deactivated. If you believe this was a mistake, please contact us.');
						redirect();
					}
				}
				# Displays Message To User for INCORRECT Email/Password Credentials
				else {
					# Flashes DANGER Information Message
					$this->session->set_flashdata('danger', 'Your email/password combination was not correct Please try again.');
					$this->load->template('users/login', $data);
				}
			}
			# If POST Form was NOT Submitted
			else {
				$this->load->template('users/login', $data);
			}
		}


		/*
			Function: User Forgot
			Description: Handles The Initial Request For Changing Forgotten Password
			Inputs: Email (POST Request)
		*/
		public function forgot(){
			$data['title'] = "User Forgot";

			# Gets Input From Forgot POST Form
			$email      = $this->input->post('userEmail');
			# Creates a Random Hash For Forgot Password Link
			$forgotHash  = bin2hex(random_bytes(16));
			$forgotDate = date('Y-m-d H:i:s');

			# If POST Form was Submitted
			if (!empty($_POST)){
				# Sets User's Forgot password Hash
				$this->user_model->setForgot($email, $forgotHash, $forgotDate);

				# Flashes SUCCESS Information Message
				$this->session->set_flashdata('success', 'Please expect an email with further instructions to the provided email shortly.');
				redirect('users/login');
			}
			# If POST Form was NOT Submitted
			else {
				$this->load->template('users/forgot', $data);
			}
		}


		/*
			Function: User Forgot Confirm
			Description: Handles The Confirmation Request For Changing Forgotten Password
			Inputs: forgotHash
		*/
		public function forgotConfirm($forgotHash = NULL){
			$data['title']      = "User Forgot | Confirm";
			$data['forgotHash'] = $forgotHash;

			# Checks If forgotHash is VALID
			$forgotCheck = $this->user_model->checkForgotHash($forgotHash);

			# If $forgotHash is VALID & within $forgotDate Acceptable Timeframe
			if ($forgotCheck[0]){
				# If POST Form was Submitted
				if (!empty($_POST)){
					# Runs Form Validation in config/form_validation.php
					$forgotValidation = $this->form_validation->run();

					# Checks if $forgotValidation returns TRUE
					if ($forgotValidation){
						# Runs Model to Set New Password
						$this->user_model->setForgotPassword($_POST);
						# Flashes SUCCESS Information Message
						$this->session->set_flashdata('success', 'You have reset your password successfully.');
						redirect('users/login');
					}
					# Checks if $forgotValidation returns FALSE
					else{
						$this->load->template('users/forgotConfirm', $data);
					}
				}
				# If POST Form was NOT Submitted
				else {
					$this->load->template('users/forgotConfirm', $data);
				}
			}
			else {
				if ($forgotCheck[1] == 'date'){
					# Flashes DANGER Information Message
					$this->session->set_flashdata('danger', 'Your forgot link has expired. Please request a new link.');
				}
				redirect('users/login');
			}
		}


	}
