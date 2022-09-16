<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">

    <link rel="stylesheet" href="./UserPoliceLogin.css">

    <title>FILE VIEW PAGE</title>
    
</head>
 
<body>
<?php
require('connection.php');

if (isset($_GET['pdf'])){
    $file=mysqli_real_escape_string($con,$_GET['pdf']);
   ?> 
   <iframe src="<?php echo $file; ?>" width="100%" height="800"  frameborder="0" ></iframe>
   <?php
}


?>

</body>

</html>