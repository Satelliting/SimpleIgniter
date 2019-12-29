<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User {

    private $CI;

    /*
		Function: Default Constructor
		Description: Default Constructor
	*/
    public function __construct(){
        $this->CI = &get_instance();

        $this->roles = array(
            0   => 'User',
            50  => 'Moderator',
            100 => 'Administrator'
        );

        $this->statuses = array(
            0 => 'Disabled',
            1 => 'Active'
        );
    }


    /*
		Function: Get Roles
		Description: Returns the value of the User Roles
	*/
    public function getRoles(){
        return $this->roles;
    }


    /*
		Function: Get Role
        Description: Returns the value of the roleID Role
        Inputs: roleID
	*/
    public function getRole($roleID){
        return $this->roles[$roleID];
    }


    /*
		Function: Get Statuses
		Description: Returns the value of the User Statuses
	*/
    public function getStatuses(){
        return $this->statuses;
    }


    /*
		Function: Get Status
        Description: Returns the value of the statusID Status
        Inputs: statusID
	*/
    public function getStatus($statusID){
        return $this->statuses[$statusID];
    }


    /*
		Function: Is User Admin
		Description: Checks If The Given User Role Is The Admin Value
		Inputs: userRole
	*/
    public function isAdmin($userRole){
        if ($userRole == array_search('Administrator', $this->roles)){
            return true;
        }
        else {
            return false;
        }
    }


}
