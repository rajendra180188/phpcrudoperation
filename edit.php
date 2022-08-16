<!DOCTYPE html>
<html lang="en">
<head>
	<title>USER UPDATE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			  <h2>EDIT USERS </h2>
			</div>
			<div class="col-md-2">
			  <a class="btn btn-primary" href="index.php">ALL USERS</a>
			</div>
			<div class="col-md-2">
			  <a class="btn btn-primary" href="add.php">ADD USER</a>
			</div>
			
		</div>
	  
	<?php 
		include("DatabaseClass.php");  
		if(!isset($_GET['editRec'])){
			header('location:index.php');
		}
		$conObj = new DatabaseClass ();  
		$userRes = $conObj->getRow("testuser",$_GET['editRec']); 
		///echo "<pre>";
		///print_r($userRes);
		$msg = "";
		
		if(isset($_POST['updateUser']) ){
			
			if(!isset($_POST['firstname']) OR $_POST['firstname'] == ''){
				$msg = $conObj->msgError("Please enter firstname");
			}
			else if(!isset($_POST['lastname']) OR $_POST['lastname'] == ''){
				$msg = $conObj->msgError("Please enter lastname");
			}
			else if(!isset($_POST['email']) OR $_POST['email'] == ''){
				$msg = $conObj->msgError("Please enter email");
			}
			/* else if(!isset($_POST['password']) OR $_POST['password'] == ''){
				$msg = $conObj->msgError("Please enter password");
			} */
			else if(!isset($_POST['city']) OR $_POST['city'] == ''){
				$msg = $conObj->msgError("Please enter city");
			}
			else if(!isset($_POST['state']) OR $_POST['state'] == ''){
				$msg = $conObj->msgError("Please enter state");
			}
			else {
				$msg = '';
				extract($_POST);
				if($firstname != "" AND $lastname != "" AND $email != "" AND $city != "" AND $state != ""){
					$userArr = [
						'firstname'	=>	$firstname,
						'lastname'	=>	$lastname,
						'email'		=>	$email,
						///'password'	=>	md5($password),
						'city'		=>	$city,
						'state'		=>	$state,
						'country'	=>	$country,
						'created_at'=>	date('Y-m-d H:I:s'),
					];
					$insertRes = $conObj->updateData('testuser',$userArr,$id);
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
			<input type="text" class="form-control hide" name="id" value="<?php echo $userRes['id']; ?>" id="firstname" data-validation="required" placeholder="Enter firstname"  >
			<div class="form-group">
				<label class="control-label col-sm-4" for="firstname">Firstname:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="firstname" value="<?php echo $userRes['firstname']; ?>" id="firstname" data-validation="required" placeholder="Enter firstname"  >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Lastname:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="lastname" value="<?php echo $userRes['lastname']; ?>" id="lastname" data-validation="required" placeholder="Enter lastname">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">email :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="email" value="<?php echo $userRes['email']; ?>" id="email" data-validation="email" placeholder="Enter email ">
				</div>
			</div>
			<!---
			<div class="form-group">
				<label class="control-label col-sm-4" for="password">password :</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="password" value="<?php echo $userRes['password']; ?>" id="password" data-validation="required" placeholder="Enter password ">
				</div>
			</div>-->
			<div class="form-group">
				<label class="control-label col-sm-4" for="city">City :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="city" value="<?php echo $userRes['city']; ?>" id="city" data-validation="required" placeholder="Enter city ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="state">State :</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="state" value="<?php echo $userRes['state']; ?>" id="state" data-validation="required" placeholder="Enter state ">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="country ">Country :</label>
				<div class="col-sm-8">
					<select class="form-control" name="country" id="country" data-validation="required">
						<option value="IN" <?php if($userRes['country']=='IN'){ echo 'seleted'; } ?>>India</option>
						<option value="AU" <?php if($userRes['country']=='AU'){ echo 'seleted'; } ?>>Australia </option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="control-label col-sm-12">
					<div class="col-sm-offset-4 col-sm-8 text-center">
						<button type="submit" name="updateUser" class="btn btn-success btn-block">Submit</button>
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
