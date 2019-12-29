<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_model extends CI_model{


		/*
			Function: Get Users
			Description: Returns ALL Users | userID User Info
			Inputs: userID
		*/
		public function getUsers($userID = NULL){
			$userInfo = NULL;

			if ($userID == NULL){
				$getSQL = "SELECT * FROM users";
			}
			else {
				$getSQL = "SELECT * FROM users WHERE userid='{$userID}'";
			}

			$queryDB  = $this->db->query($getSQL);
			$userInfo = $queryDB->result();
			return $userInfo;
		}


		/*
			Function: Delete User
			Description: Deletes the User from the Database
			Inputs: userID
		*/
		public function deleteUser($userID){
			$dbCheck = $this->db->delete('users', array('userID' => $userID));
			if($dbCheck){
				return true;
			}
			return false;
		}


	}
