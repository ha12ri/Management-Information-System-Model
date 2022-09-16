<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">

    <link rel="stylesheet" href="./UserPoliceLogin.css">

    <title>Police Login Page</title>
</head>

<body>

    <div id="particles-js"></div>
    <section id="LoginPhase">
    <?php
require('connection.php');
session_start();

if (isset($_POST['policeid'])){

    $user_name=$_REQUEST['user_name'];
    $policeid=$_REQUEST['policeid'];
	$pass = ($_REQUEST['pass']);
    $query = "SELECT * FROM `police` WHERE `policeid`='$policeid' and `user_name`='$user_name' and `pass`='' + '$pass'";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
    $query2 = "SELECT * FROM `policeverify` WHERE `policeid`='$policeid' and `checkpolice`='yes'";
    $result2 = mysqli_query($con,$query2) or die(mysqli_error($con));
	$rows2 = mysqli_num_rows($result2);
        if($rows==1){
            if($rows2==1){
	    $_SESSION['policeid'] = $policeid;
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d');
        $time=date("H:i:s");
                $w=mysqli_query($con,"INSERT INTO attendence (`policeid`,`date`,`time`,`attendence`) values('$policeid','$date','$time','present')");

            
        header("Location: welcome_police.php");
	   
         }
         else{
            echo "<div class='form'>
<h3 style=color:white; >Your Police ID not approved yet from Admin,Kindly Wait! <a style=color:orange; href='PoliceLogin.php'>Try Again</a></h3>
<br> </div>";
        }
    }
        else{
	echo "<div class='form'>
<h3 style=color:white; >Police ID/Username/password is incorrect, <a style=color:orange; href='PoliceLogin.php'>Try Again</a></h3>
<br> </div>";
	}
    }else{
?>

        <div class="form-section-field">
            <h1 class="heading">LOG IN (POLICE OFFICERS) </h1>
            <form action="" method="post" name="login">

                <div> <input class="input-pl" type="text" name="user_name" placeholder="User Name" required /></div>
                <div><input class="input-pl" type="text" name="policeid" placeholder="Police ID" required /></div>
                <div> <input class="input-pl" type="password" name="pass" placeholder="Password" required /></div>

                <input id="button-login" name="submit" type="submit" value="LOGIN" />
            </form>
            <p class="userReg">Don't have an Account? <a href='./PoliceRegistration.php'>Register Here</a></p>
        </div>
    </section>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS.load('particles-js', 'particles.json');
    </script>

</body>

</html>