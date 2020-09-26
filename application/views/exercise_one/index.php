<!DOCTYPE html>
<html>
<head>
	<title>Exerceise One</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>

	<div class="container mt-3">
		<h5 style="">Exercise 1 - Q2</h5>
		<p>Create/Edit form for database</p>
		<form name="router_properties" action="<?php echo base_url();?>excercise_one/update" method="POST">
		  <div class="form-group">
			<label for="sapid">SAP ID</label>
			<input type="text" class="form-control" id="sapid" name="sapid" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Enter SAP ID here of the format: 12:12:34:65-e3:t5:87:5411:57</small>
		  </div>
		  <div class="form-group">
			<label for="hostname">Host Name</label>
			<input type="text" class="form-control" id="hostname" name="hostname" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Enter Hostname http://www.example.com</small>
		  </div>
		  <div class="form-group">
			<label for="loopback">Loopback IP</label>
			<input type="text" class="form-control" id="loopback" name="loopback" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Enter Loopback IP of format: 192.168.1.111:57</small>
		  </div>
		  <div class="form-group">
			<label for="macaddress">Mac Address</label>
			<input type="text" class="form-control" id="macaddress" name="macaddress" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Enter SAP ID here of the format: 02:42:a8:4a:80:75</small>
		  </div>
		  <button type="submit" class="btn btn-primary float-right">Submit</button>
		</form>
	</div>



</body>
</html>