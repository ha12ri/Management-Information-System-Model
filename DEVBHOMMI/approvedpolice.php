
<html>

<head>
 <style> <?php echo include 'welcome_police.css' ?></style>

</head>

<body>

  <?php
 include('connection.php');
 $rows = mysqli_query($con, "SELECT * FROM police where adminc='yes'");
  ?>
  <table class="clist" align="center" border="1">
    <tr>
      <td>Serial No.</td>
      <td>Email</td>
      <td>Police User Name</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Mobile Number</td>
      <td>Police ID</td>
      <td>Police ID File</td>
      <td>Joining Date</td>
      <td>Office Name</td>
      <td>Office District</td>
      

    </tr>

    <?php $i = 1; ?>
    <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["first_name"]; ?></td>
        <td><?php echo $row["last_name"]; ?></td>
        <td><?php echo $row["mobile_no"]; ?></td>
        <td><?php echo $row["policeid"]; ?></td>
        <td><a target="_blank" class="appbtn2" href="fileview.php?pdf=<?=$row['document']?>">VIEW</a></td>
        <td><?php echo $row["joiningdate"]; ?></td>
        <td><?php echo $row["office"]; ?></td>
        <td><?php echo $row["police_city"]; ?></td>
</td>

      </tr>
      <?php endforeach; ?>
    </table>
   



</body>
</html>