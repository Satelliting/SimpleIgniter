<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class MY_Form_validation extends CI_Form_validation {
        /*
			Function: Password Requirement Callback
			Description: Handles The Password Requirement Verification
			Inputs: Unhashed Password
			Outputs: true / false (boolean)
		*/
		public function password_check($password){
			# Verifies Alpha Characters in $password
			if (preg_match('~[a-zA-Z]~', $password)){
				# Verifies Numeric Characters in $password
				if (preg_match('~[0-9]~', $password)){
					# Verifies Special Characters in $password
					if (preg_match('~[\W]~', $password)){
						return true;
					}
					else {
						return false;
					}
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}

		/*
			Function: Edit Self Email Unique Requirement Callback
			Description: Handles The Email Unique Requirement Verification for Profile/Edit Form
			Inputs: email
			Outputs: true / false (boolean)
		*/
		public function edit_email_unique($email){
			# Retrieves ANY User Row that CONTAINS the $email
			$getSQL     = "SELECT * FROM users WHERE userEmail='{$email}'";
			$queryDB    = $this->CI->db->query($getSQL);
			$emailCheck = $queryDB->result();

			# If there IS a Row with $email
			if ($emailCheck){
				# Makes $emailCheck maleable
				$emailCheck = (array) $emailCheck[0];
				
				# If SELF is editing Email
				if ($this->CI->uri->segment(4) == NULL){
					$userID = $this->CI->session->userdata('userID');
				}
				# If ADMIN is editing Email
				else {
					$userID = $this->CI->uri->segment(4);
				}

				# If $userID is NOT the SAME as Current
				if ($userID != $emailCheck['userID']){
					return false;
				}
				# If $userID is the SAME as Current
				else {
					return true;
				}
			}
			# If there is NOT a Row with $email
			else {
				return true;
			}
		}


    }
