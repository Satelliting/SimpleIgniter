<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class User_model extends CI_model{


		/*
			Function: User Login Model
			Description: Handles The User Login Database Query
			Inputs: Email, Password
			Outputs: True -> Array ($queryDB->result()), False -> false (boolean)
		*/
		public function userLogin($email, $password){
			$loginSQL = "SELECT * FROM users WHERE userEmail = '{$email}' AND userPassword = '{$password}'";
			$queryDB  = $this->db->query($loginSQL);
			$query    = $queryDB->result();

			if (!empty($query)){
				return $query;
			}
			else {
				return false;
			}
		}


		/*
			Function: User Registration Model
			Description: Handles The User Registration Database Query
			Inputs: UserInfo (Array)
			Outputs: true, false (boolean)
		*/
		public function userRegister($userInfo){
			if($this->db->insert('users', $userInfo)){
				return true;
			}
			else {
				return false;
			}
		}



		# Edit User Info Model
		/*
			Function: Edit User Info Model
			Description: Handles The User Changing His Information
			Inputs: UserInfo (Array)
		*/
		public function userEdit($userInfo){
			$getSQL   = "SELECT * FROM users WHERE userid='{$userInfo['userID']}'";
			$queryDB  = $this->db->query($getSQL);
			$userData = $queryDB->result();

			$userData = (array) $userData[0];

			$this->db->where('userID', $userInfo['userID']);
			$this->db->update('users', $userInfo);

			return true;
		}


		/*
			Function: Initial Forgot Password Model
			Description: Handles The Initial Forgot Password Query
			Inputs: Email, ForgotHash, ForgotDate
		*/
		public function setForgot($userEmail, $forgotHash, $forgotDate){
			$this->db->where('userEmail', $userEmail);
			$this->db->update('users', array("userForgot" => $forgotHash, "userForgotDate" => $forgotDate));

			return true;
		}


		/*
			Function: Check Forgot Password Model
			Description: Handles The Checking of the Forgot Password Query
			Inputs: ForgotHash
		*/
		public function checkForgotHash($forgotHash){
			$getSQL    = "SELECT * FROM users WHERE userForgot='{$forgotHash}'";
			$queryDB   = $this->db->query($getSQL);
			$hashCheck = $queryDB->result();

			# If $forgotHash is NOT Valid
			if (empty($hashCheck)){
				return array(false, 'hash');
			}
			else {
				# Allows $hashCheck to be Manipulated To Check 
				$hashCheck = (array) $hashCheck[0];
			}

			# If $forgotDate is over 24hrs
			if (strtotime($hashCheck['userForgotDate']) < strtotime(date('Y-m-d H:i:s'))-86400){
				# Resets $forgotHash Link
				$this->db->where('userForgot', $forgotHash);
				$this->db->update('users', array("userForgot" => NULL, "userForgotDate" => NULL));

				return array(false, 'date');
			}

			# If Both Checks Come Back True
			return array(true);
		}


		/*
			Function: Check Forgot Password Model
			Description: Handles The Checking of the Forgot Password Query
			Inputs: userInfo ($_POST Array)
		*/
		public function setForgotPassword($userInfo){
			$this->db->where('userForgot', $userInfo['forgotID']);
			$this->db->update('users', array("userPassword" => $this->encryption->password_hash($userInfo['userPassword']), "userForgot" => NULL, "userForgotDate" => NULL));
			return true;
		}


		/*
			Function: Check User Status
			Description: Checks if the User is Active or Disabled
			Inputs: userID
		*/
		public function checkStatus($userID){
			$loginSQL = "SELECT * FROM users WHERE userID = '{$userID}'";
			$queryDB  = $this->db->query($loginSQL);
			$query    = (array) $queryDB->result()[0];

			if ($query['userStatus'] == 0){
				# Logs the Current User OUT
				$this->session->sess_destroy();

				# Flashes DANGER Information Message
				$this->session->set_flashdata('danger', 'Your account has been banned/deactivated. If you believe this was a mistake, please contact us');
				redirect();
			}
		}


	}
