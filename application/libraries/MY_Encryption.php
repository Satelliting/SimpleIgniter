<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class MY_Encryption extends CI_Encryption {
        /*
			Function: Password Hash Callback
			Description: Handles The Hashing of $password to Hash Version
			Inputs: Unhashed String
			Outputs: Hashed String (SHA3-512)
		*/
		public function password_hash($password){
			return hash('sha3-512', $password);
		}
    }
