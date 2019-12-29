<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container-float text-center">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
								<tr class="text-center">
									<th>User ID</th>
									<th>User Email</th>
									<th>User Full Name</th>
									<th>User Role</th>
									<th>User Status</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr class="text-center">
									<th>User ID</th>
									<th>User Email</th>
									<th>User Full Name</th>
									<th>User Role</th>
									<th>User Status</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>
<?php
	foreach ($userList as $user){
		$user = (array) $user;

		echo '
								<tr class="text-center">
									<td>#'.$user["userID"].'</td>
									<td><a href="'.site_url("admin/users/email/".$user["userID"]).'">'.$user["userEmail"].'</a></td>
									<td>'.$user["userFirstName"]." ".$user["userLastName"].'</td>
									<td>'.$this->user->getRole($user['userRole']).'</td>
									<td>'.$this->user->getStatus($user['userStatus']).'</td>
									<td><a class="btn btn-info" href="'.site_url("admin/users/edit/".$user["userID"]).'">Edit User</a></td>
								</tr>
		';
	}
?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
