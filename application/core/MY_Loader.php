<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE){
		# Default Header/Footer
		$header = 'templates/header';
		$footer = 'templates/footer';

		# Checks if ADMIN Page Request
		if (strpos($template_name, 'admin') === 0){
			$header = 'templates/header_admin';
			$footer = 'templates/footer_admin';
		}

		# If Needing to Return Content
		if ($return){
			$content  = $this->view($header, $vars, $return);
			$content .= $this->view($template_name, $vars, $return);
			$content .= $this->view($footer, $vars, $return);

			return $content;
		}
		# If NOT Needing to Return Content
		else {
			$this->view($header, $vars);
			$this->view($template_name, $vars);
			$this->view($footer, $vars);
		}
	}
}
