<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
<body>
<br>
<div id="container " class="col-md-5">
	<div class="panel panel-default ">
		<div class="panel-heading">Registration</div>
		<div class="panel-body">
			<?php 
				if($this->session->flashdata('message'))
				{
					echo '<div class="alert alert-success">
						'.$this->session->flashdata('message').'

					</div>';
				}

			?>
			<form method="post" action="<?php echo base_url();?>main/registration">
				<div class="form-group">
					<label>Enter Name</label>
					<input type="text" class="form-control" name="user_name" value="<?php echo set_value('user_name'); ?>" />
					<span class="text text-danger"><?php echo form_error('user_name'); ?></span>
				</div>
				<div class="form-group">
					<label>Enter Email</label>
					<input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" />
					<span class="text text-danger"><?php echo form_error('email'); ?></span>
				</div>
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" />
					<span class="text text-danger"><?php echo form_error('password'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-info" name="submit" value="Register" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>login">Login</a>
				</div>
			</form>	
		</div>
	</div>
</div>

</body>
</html>