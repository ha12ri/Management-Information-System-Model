<?php
session_start();
if(!isset($_SESSION["adminid"])){
header("Location: adminlogin.php");
exit(); }
?>
<html>

<head>
 <style> <?php echo include 'welcome_police.css' ?></style>

</head>

<body>

  <?php
 include('connection.php');
 $rows = mysqli_query($con, "SELECT * FROM attendence");
  ?>
  <table class="clist" align="center" border="1">
    <tr>
      <td>Serial No.</td>
      <td>Police ID</td>
      <td>Date</td>
      <td>Time Of Attendence</td>
      <td>Attendence</td>
      

    </tr>

    <?php $i = 1; ?>
    <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["policeid"]; ?></td>
        <td><?php echo $row["date"]; ?></td>
        <td><?php echo $row["time"]; ?></td>
        <td><?php echo $row["attendence"]; ?></td>
</td>

      </tr>
      <?php endforeach; ?>
    </table>
   



</body>
</html>