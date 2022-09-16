<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
    <link rel="stylesheet" href="./UserPoliceLogin.css">

    <title>User Login Page</title>
</head>

<body>

    <section id="LoginPhase">
    <?php
require('connection.php');
session_start();

if (isset($_POST['user_name'])){
  
    $user_name = $_REQUEST['user_name'];
	$pass = ($_REQUEST['pass']);
    
   
    $query2 = "SELECT * FROM `regist` WHERE `user_name`='$user_name' and `pass`='' + '$pass'";
	$result = mysqli_query($con,$query2) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['user_name'] = $user_name;
	    header("Location: welcome_user.php");
         }else{
            echo "<div class='form'>
            <h3 style=color:white; >Username /password is incorrect, <a style=color:orange; href='UserLogin.php'>Try Again</a></h3>
            <br> </div>";
	}
    }else{
?>
        <div id="particles-js"></div>
        <div class="form-section-field">
            <h1 class="heading">LOG IN</h1>
            <form action="" method="post" name="login">

                <div> <input class="input-pl" type="text" name="user_name" placeholder="User Name" required/></div>
                <div> <input class="input-pl" type="password" name="pass" placeholder="Password" required /></div>

                <input id="button-login" name="submit" type="submit" value="LOGIN" />
            </form>
            <p class="userReg">Don't have an Account? <a href='./UserRegistration.php'>Register Here</a></p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS.load('particles-js', 'particles.json');
    </script>
<?php } ?>
</body>

</html>