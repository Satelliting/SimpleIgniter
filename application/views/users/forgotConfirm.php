<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container">
<?=validation_errors();?>
			<div class="row" style="padding-bottom: 20px;">
				<img src="<?=base_url('/assets/img/logo.png');?>" class="mx-auto" />
			</div>

			<div class="card">
				<div class="card-header">
					<h2>User Forgot - Confirm</h2>
				</div>
				<div class="card-body">
					<?=form_open(current_url());?>
						<fieldset>
							<div class="form-group">
								<input class="form-control" type="hidden" name="forgotID" value="<?=$forgotHash;?>" required />
								<input class="form-control" placeholder="Password" name="userPassword" type="password" required />
								<small class="form-text text-muted">
									Your password has to meet the following requirements:
									<ul>
										<li>Must be at least 8 characters long</li>
										<li>Must include a letter</li>
										<li>Must include a number</li>
										<li>Must include a special character</li>
									</ul>
								</small>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="userPasswordConfirm" type="password" required />
							</div>
							<input class="btn btn-lg btn-success btn-block" type="submit" value="Reset Password" />
						</fieldset>
					</form>
				</div>
			</div>
		</div>
