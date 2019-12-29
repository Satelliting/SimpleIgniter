<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container">
<?=validation_errors();?>
			<div class="card">
				<div class="card-header">
					<h2>Edit User Info: <strong><?=$editUserInfo['userFirstName'];?> <?=$editUserInfo['userLastName'];?></strong> #<em><?=$editUserInfo['userID'];?></em></h2>
				</div>
				<div class="card-body">
					<?=form_open(current_url());?>
						<fieldset>
							<div class="form-group">
								<input class="form-control" name="userID" type="hidden" required value="<?=$editUserInfo['userID'];?>" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="First Name" name="userFirstName" type="text" required autofocus value="<?=$editUserInfo['userFirstName'];?>" data-toggle="tooltip" data-placement="left" title="User First Name" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Last Name" name="userLastName" type="text" required value="<?=$editUserInfo['userLastName'];?>" data-toggle="tooltip" data-placement="left" title="User Last Name" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="userEmail" type="email" required value="<?=$editUserInfo['userEmail'];?>" data-toggle="tooltip" data-placement="left" title="User Email" />
							</div>
							<div class="form-group">
								<select class="form-control" name="userRole" data-toggle="tooltip" data-placement="left" title="User Role">
<?php
	foreach ($this->user->getRoles() as $roleID => $roleName){
		# Used To Set selected Option Choice
		$currentRole = '';

		# Checks if Current roleID is EQUAL to userRole
		if ($roleID == $editUserInfo['userRole']){
			$currentRole = ' selected';
		}

		echo '
									<option value="'.$roleID.'"'.$currentRole.'>'.$roleName.'</option>
		';

		# Resets currentRole EVERY Loop
		$currentRole = '';
	}

?>
								</select>
							</div>




							<div class="form-group">
								<select class="form-control" name="userStatus" data-toggle="tooltip" data-placement="left" title="User Status">
<?php
	foreach ($this->user->getStatuses() as $statusID => $statusName){
		# Used To Set selected Option Choice
		$currentStatus = '';

		# Checks if Current roleID is EQUAL to userRole
		if ($statusID == $editUserInfo['userStatus']){
			$currentStatus = ' selected';
		}

		echo '
									<option value="'.$statusID.'"'.$currentStatus.'>'.$statusName.'</option>
		';

		# Resets currentRole EVERY Loop
		$currentStatus = '';
	}
?>
								</select>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="New Password" name="userPassword" type="password" data-toggle="tooltip" data-placement="left" title="(Optional)" />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Confirm New Password" name="userPasswordConfirm" type="password" data-toggle="tooltip" data-placement="left" title="(Optional)" />
							</div>
							<input class="btn btn-lg btn-success btn-block" type="submit" value="Submit Changes" />
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row" style="padding-top: 40px;">

				<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
					Delete User: #<?=$editUserInfo['userID'];?>
				</button>

				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Delete User: #<?=$editUserInfo['userID'];?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<p>
						Are you sure you wish to delete the following user? If you do so, you will delete the entire user profile and this action is irreverisble.
					</p>
					<p class="text-right">
						<small>(All user logs will still be stored for security and safety)</small>
					</p>
				</div>
				<div class="modal-footer">
				<?=form_open(current_url());?>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<input type="hidden" name="delete" value="Y" />
					<input type="submit" class="btn btn-danger" value="Delete User" />
				</form>
				</div>
				</div>
				</div>
				</div>



			</div>
		</div>
