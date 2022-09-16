<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">

    <link rel="stylesheet" href="./UserPoliceLogin.css">

    <title>Admin Login Page</title>
</head>

<body>

    <div id="particles-js"></div>
    <section id="LoginPhase">
        <?php
require('connection.php');
session_start();

if (isset($_POST['adminid'])){

    $adminid=$_REQUEST['adminid'];
	$pass = ($_REQUEST['pass']);
    $query = "SELECT * FROM `admin` WHERE `adminid`='$adminid' and `pass`='' + '$pass'";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['adminid'] = $adminid;
	    header("Location: admin.php");
         }else{
	echo "<div class='form'>
<h3 style=color:white; > You are not an admin, <a style=color:orange; href='adminlogin.php'>Try Again</a></h3>
<br> </div>";
	}
    }else{
?>

            <div class="form-section-field">
                <h1 class="heading">LOG IN (ADMIN ONLY) </h1>
                <form action="" method="post" name="login">

                    <div> <input class="input-pl" type="text" name="adminid" placeholder="Admin ID" required /></div>
                    <div> <input class="input-pl" type="password" name="pass" placeholder="Password" required /></div>

                    <input id="button-login" name="submit" type="submit" value="LOGIN" />
                </form>
            </div>
    </section>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS.load('particles-js', 'particles.json');
    </script>

</body>

</html>