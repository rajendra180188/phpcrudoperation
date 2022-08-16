<!DOCTYPE html>
<html lang="en">
<head>
	<title>USER FORM</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-9">
			  <h2>ADD USERS </h2>
			</div>
			<div class="col-md-3">
			  <a class="btn btn-primary" href="index.php">ALL USERS</a>
			</div>
		</div>
	  
	<?php 
		include("DatabaseClass.php");  
		$conObj = new DatabaseClass ();  
		$userRes = $conObj->getAll("testuser"); 
		$msg = "";
		
		if(isset($_POST['addUser']) ){
			if(!isset($_POST['termscond']) OR $_POST['termscond'] != 'on'){
				$msg =  $conObj->msgError("Please checked terms and conditions");
			}
			if(!isset($_POST['firstname']) OR $_POST['firstname'] == ''){
				$msg = $conObj->msgError("Please enter firstname");
			}
			else if(!isset($_POST['lastname']) OR $_POST['lastname'] == ''){
				$msg = $conObj->msgError("Please enter lastname");
			}
			else if(!isset($_POST['email']) OR $_POST['email'] == ''){
				$msg = $conObj->msgError("Please enter email");
			}
			else if(!isset($_POST['password']) OR $_POST['password'] == ''){
				$msg = $conObj->msgError("Please enter password");
			}
			else if(!isset($_POST['city']) OR $_POST['city'] == ''){
				$msg = $conObj->msgError("Please enter city");
			}
			else if(!isset($_POST['state']) OR $_POST['state'] == ''){
				$msg = $conObj->msgError("Please enter state");
			}
			else {
				$msg = '';
				extract($_POST);
				if(isset($termscond) AND $firstname != "" AND $lastname != "" AND $email != "" AND $password != "" AND $city != "" AND $state != ""){
					$userArr = [
						'firstname'	=>	$firstname,
						'lastname'	=>	$lastname,
						'email'		=>	$email,
						'password'	=>	md5($password),
						'city'		=>	$city,
						'state'		=>	$state,
						'country'	=>	$country,
						'created_at'=>	date('Y-m-d H:I:s'),
					];
					$insertRes = $conObj->inserData('testuser',$userArr);
					if($insertRes){
						$msg = $conObj->msgSuccess("Record succesfully inserted.");
						$_POST = [];
					}
				}
			}
			echo $msg;
		}
		
	?>
		<form  class="form-horizontal" id="userForm" method="post" action="#<?php ///echo $_SERVER[" PHP_SELF "]; ?>">
			<div class="form-group">
				<label class="control-label col-sm-4" for="firstname">Firstname:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="firstname" value="<?php echo isset($_POST['firstname'])?$_POST['firstname']:''; ?>" id="firstname" data-validation="required" placeholder="Enter firstname"  >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Lastname:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="lastname" value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:''; ?>" id="lastname" data-validation="required" placeholder="Enter lastname">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">email :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" id="email" data-validation="email" placeholder="Enter email ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="password">password :</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="password" value="<?php echo isset($_POST['password'])?$_POST['password']:''; ?>" id="password" data-validation="required" placeholder="Enter password ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="city">City :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="city" value="<?php echo isset($_POST['city'])?$_POST['city']:''; ?>" id="city" data-validation="required" placeholder="Enter city ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="state">State :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="state" value="<?php echo isset($_POST['state'])?$_POST['state']:''; ?>" id="state" data-validation="required" placeholder="Enter state ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="country ">Country :</label>
				<div class="col-sm-8">
					<select class="form-control" name="country" id="country" data-validation="required">
						<option value="IN">India</option>
						<option value="AU">Australia </option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label col-sm-12">
					<div class="col-sm-6">
						<label class="checkbox"><input type="checkbox" name="termscond"  value="<?php echo $_POST['firstname']?'checked':''; ?>" data-validation="required">Agree to the terms and conditions</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label col-sm-12">
					<div class="col-sm-offset-4 col-sm-8 text-center">
						<button type="submit" name="addUser" class="btn btn-success btn-block">Submit</button>
					</div>
				</div>
			</div>
			
		</form>

	</div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
	<script>
		$.validate({
			modules : 'date'
		});
	</script>
</body>
</html>
