<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	$config = array(
		# Registration Form Validation Rules
		'users/register' => array(
			array(
				'field'  => 'userFirstName',
				'label'  => 'First Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.',
				),
			),

			array(
				'field'  => 'userLastName',
				'label'  => 'Last Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.',
				),
			),

			array(
				'field'  => 'userEmail',
				'label'  => 'Email',
				'rules'  => 'trim|required|min_length[3]|max_length[255]|valid_email|is_unique[users.userEmail]',
				'errors' => array(
					'required'    => 'You must provide a %s for your account.',
					'min_length'  => 'You have too few characters for your %s.',
					'max_length'  => 'You have too many characters for your %s.',
					'valid_email' => 'The %s provided was not valid.',
					'is_unique'   => 'The %s provided was not unique.'
				),
			),

			array(
				'field'  => 'userPassword',
				'label'  => 'Password',
				'rules'  => 'required|min_length[8]|password_check',
				'errors' => array(
					'required'       => 'You must provide a %s for your account.',
					'min_length'     => 'You have too few characters for your %s.',
					'password_check' => 'You do not have the correct amount of letters, numbers, or special characters in your password.'
				),
			),

			array(
				'field'  => 'userPasswordConfirm',
				'label'  => 'Password Confirmation',
				'rules'  => 'required|matches[userPassword]',
				'errors' => array(
					'required'              => 'You must provide a %s for your account.',
					'matches[userPassword]' => 'Your %s did not match.'
				),
			),
		),

		# Forgot Confirm Form Validation Rules
		'users/forgotConfirm' => array(
			array(
				'field'  => 'userPassword',
				'label'  => 'Password',
				'rules'  => 'required|min_length[8]|password_check',
				'errors' => array(
					'required'       => 'You must provide a %s for your account.',
					'min_length'     => 'You have too few characters for your %s.',
					'password_check' => 'You do not have the correct amount of letters, numbers, or special characters in your password.'
				),
			),

			array(
				'field'  => 'userPasswordConfirm',
				'label'  => 'Password Confirmation',
				'rules'  => 'required|matches[userPassword]',
				'errors' => array(
					'required'              => 'You must provide a %s for your account.',
					'matches[userPassword]' => 'Your %s did not match.'
				),
			),
		),

		# Update Account Form Validation Rules
		'profile/edit' => array(
			array(
				'field'  => 'userFirstName',
				'label'  => 'First Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.'
				),
			),

			array(
				'field'  => 'userLastName',
				'label'  => 'Last Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.'
				),
			),

			array(
				'field'  => 'userEmail',
				'label'  => 'Email',
				'rules'  => 'trim|required|min_length[3]|max_length[255]|valid_email|edit_email_unique',
				'errors' => array(
					'required'    => 'You must provide a %s for your account.',
					'min_length'  => 'You have too few characters for your %s.',
					'max_length'  => 'You have too many characters for your %s.',
					'valid_email' => 'The %s provided was not valid.',
					'edit_email_unique' => 'The %s provided is already registered.'
				),
			),

			array(
				'field'  => 'userPassword',
				'label'  => 'Password',
				'rules'  => 'min_length[8]|password_check',
				'errors' => array(
					'min_length'     => 'You have too few characters for your %s.',
					'password_check' => 'You do not have the correct amount of letters, numbers, or special characters in your password.'
				),
			),

			array(
				'field'  => 'userPasswordConfirm',
				'label'  => 'Password Confirmation',
				'rules'  => 'matches[userPassword]',
				'errors' => array(
					'matches[userPassword]' => 'Your %s did not match.'
				),
			)
		),

		# Update Account (Admin) Form Validation Rules
		'admin/users/edit' => array(
			array(
				'field'  => 'userID',
				'label'  => 'User ID',
				'rules'  => 'trim|required',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.'
				),
			),

			array(
				'field'  => 'userFirstName',
				'label'  => 'First Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.'
				),
			),

			array(
				'field'  => 'userLastName',
				'label'  => 'Last Name',
				'rules'  => 'trim|required|min_length[1]|max_length[50]',
				'errors' => array(
					'required'   => 'You must provide a %s for your account.',
					'min_length' => 'You have too few characters for your %s.',
					'max_length' => 'You have too many characters for your %s.'
				),
			),

			array(
				'field'  => 'userEmail',
				'label'  => 'Email',
				'rules'  => 'trim|required|min_length[3]|max_length[255]|valid_email|edit_email_unique',
				'errors' => array(
					'required'    => 'You must provide a %s for your account.',
					'min_length'  => 'You have too few characters for your %s.',
					'max_length'  => 'You have too many characters for your %s.',
					'valid_email' => 'The %s provided was not valid.',
					'edit_email_unique' => 'The %s provided is already registered.'
				),
			),

			array(
				'field'  => 'userPassword',
				'label'  => 'Password',
				'rules'  => 'min_length[8]|password_check',
				'errors' => array(
					'min_length'     => 'You have too few characters for your %s.',
					'password_check' => 'You do not have the correct amount of letters, numbers, or special characters in your password.'
				),
			),

			array(
				'field'  => 'userPasswordConfirm',
				'label'  => 'Password Confirmation',
				'rules'  => 'matches[userPassword]',
				'errors' => array(
					'matches[userPassword]' => 'Your %s did not match.'
				),
			)
		)
	);

	$config['error_prefix'] = '<div class="alert alert-danger alert-dismissible fade show print-error-msg" role="alert">';
	$config['error_suffix'] = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
