<!DOCTYPE html>
<html lang="en">
<head>
	<title>ALL USER</title>
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
		  <h2>USERS LISTING</h2>
		</div>
		<div class="col-md-3">
		  <a class="btn btn-primary" href="add.php">ADD NEW</a>
		</div>
	</div>
  
<?php 
	include("DatabaseClass.php");  
	$conObj = new DatabaseClass ();  
	$userRes = $conObj->getAll("testuser"); 
	$msg = '';
	if(isset($_GET['delRec'])){
		$delRes = $conObj->deleteData("testuser",$_GET['delRec']);
		if($delRes){
			$msg = $conObj->msgSuccess("Record succesfully deleted.");
			echo $msg;
		} else {
			$msg = $conObj->msgError("Please enter state");
			echo $msg;
		}
		///header('location:index.php');
	}
	
	
?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>City</th>
        <th>State</th>
        <th>Country </th>
        <th>Action </th>
      </tr>
    </thead>
    <tbody>
	<?php
		if(!empty($userRes)){	
		foreach($userRes as $userResVal){
	?>
      <tr>
        <td><?php echo $userResVal['firstname']; ?></td>
        <td><?php echo $userResVal['lastname']; ?></td>
        <td><?php echo $userResVal['email']; ?></td>
        <td><?php echo $userResVal['city']; ?></td>
        <td><?php echo $userResVal['state']; ?></td>
        <td><?php 
				$country = '';
				if($userResVal['country'] == 'IN'){
					$country = 'India';
				}
				else if($userResVal['country'] == 'AU'){
					$country = 'Australia';
				}
				echo $country;
		?></td>
        <td><a class="btn btn-success btn-sm" href="edit.php?editRec=<?php echo $userResVal['id']; ?>" title="EDIT DATA">EDIT</a></td>
        <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');" href="index.php?delRec=<?php echo $userResVal['id']; ?>" title="DELETE ROW">DELETE</a></td>
        
      </tr>
	<?php
			}
		}
	?>
    </tbody>
  </table>
</div>

</body>
</html>
