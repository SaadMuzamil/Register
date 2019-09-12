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
		<div class="panel-heading">Register here</div>
		<div class="panel-body">
		<?php
			if($this->session->flashdata('message'))
			{
				echo '<div class="alert alert-success">'.$this->session->flashdata('message').'</div>';
			}

		 ?>
			<form method="post" action="<?php echo base_url();?>login/validation">
				<div class="form-group">
					<label>Enter Email Address</label>
					<input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" />
					<span class="text text-danger"><?php echo form_error('email'); ?></span>
				</div>
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" />
					<span class="text text-danger"><?php echo form_error('password'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-info" name="submit" value="Login" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>main/registration">Register</a>
				</div>
			</form>	
		</div>
	</div>
</div>

</body>
</html>
