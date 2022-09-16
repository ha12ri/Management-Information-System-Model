<?php 

require_once ('connection.php');


if(isset($_POST['sign_up']))
{   $first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$user_name=$_POST['user_name'];
	$email=$_POST['email'];
	$mobile_no=$_POST['mobile_no'];
	$aadharno=$_POST['aadharno'];
	$pass=$_POST['pass'];
	$c_pass=$_POST['c_pass'];
	$check_email = mysqli_query($con, "SELECT email FROM regist where email = '$email' ");
	$check_aadhar = mysqli_query($con, "SELECT aadharno FROM regist where aadharno= '$aadharno' ");
	$result = mysqli_query($con,"SELECT `user_name` FROM regist WHERE `user_name`='{$user_name}'") or die("Query unsuccessful") ;
	if(mysqli_num_rows($check_email)> 0){
		echo('Email Already exists');
	}
	elseif(mysqli_num_rows($check_aadhar) > 0){
		echo('Aadhar Already Registered');

	}
	elseif (mysqli_num_rows($result) > 0) {
	 echo " Username is already exist";}
	
		    elseif(strlen($user_name)<2 && strlen($user_name)>15)
			{
				echo "Enter Character between 3 To 15 .";
			}
			elseif (strlen($pass)<=6 && strlen($pass)>=20)
			{
				
			}
			elseif (strlen($pass)<=6 && strlen($pass)>=20)
			{
			
			}
			elseif ($pass != $c_pass)
			{
				echo "<script>alert('Password Does Not Same')</script>";
			}
			elseif(strlen($aadharno)!=12)
			{
				echo "<script>alert('Aadhar Number must be 12 digits')</script>";
				
			}
            else{
				$path = "useraadharcard/";
				$temp = explode(".", $_FILES["file"]["name"]);
                $filename = $aadharno. '.' . end($temp);
				$path = $path .$filename;
			   
				if(move_uploaded_file($_FILES['file']['tmp_name'], $path) ){
				
                $aResult = mysqli_query($con, "INSERT INTO regist (`first_name`,`last_name`,`user_name`,`email`,`mobile_no`,`aadharno`,`pass`,`document`) values ('$first_name','$last_name','$user_name','$email','$mobile_no','$aadharno','$pass','$path')");
                 echo "<script>alert('Registered Succesfully You can Log In Now')</script>";
				 header("location:UserLogin.php");
        }
        }
	}
?>

<html>

<head>
	<link rel="stylesheet" href="./UserRegistration.css">
	<title>User Registration Page</title>
	<link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
</head>

<body>

	<section id="hero">
		<form action="" method="post" name="user" enctype="multipart/form-data">
			<h1 class="heading">SIGN UP FOR USER</h1>
			<div class="container">

				<div class="box-div">
					<input id="first_name" type="text" name="first_name" placeholder="First Name" value="" required>
					<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="" required>
				</div>

				<div class="box-div">
					<input id="email" type="text" name="email" placeholder="Email ID" value="" required>
					<input id="User_Name" type="text" name="user_name" placeholder="Enter Your User Name" required>
				</div>

				<div class="box-div">
					<input id="pass" type="password" name="pass" placeholder="Enter Password" maxlength="16" required>
					<input id="c_pass" type="password" name="c_pass" placeholder="Enter Confirm Password" maxlength="16"
						required>
				</div>
				<div class="box-div">
					<input id="aadharno" type="number" name="aadharno" placeholder="Enter Aadhar Card Number"
						maxlength="12" size="12" value="" required>
					<input id="mobile" type="number" name="mobile_no" placeholder="Mobile No." maxlength="10" size="10" value="" required>
				</div>

				<div class="box-div">
					<label for="aadharphoto" class="photoAdr">Submit an Pdf of your Adhar card</label>
					<input id="aadharphoto" type="file" name="file" accept=".pdf" required>

				</div>

				<div class="box-div">
					<input id="submit" type="submit" name="sign_up" value="SIGN UP">
				</div>
				<p class="RegiUser">Already have an Account <a href='./UserLogin.php' target="_blank">LOGIN</a></p>

</div>

		</form>
	</section>
</body>

</html>