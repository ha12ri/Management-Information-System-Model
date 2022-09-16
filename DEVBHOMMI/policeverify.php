
<html>

<head>
  <link rel="stylesheet" href="./welcome_police.css">
</head>

<body>

  <?php
 include('connection.php');
 $rows = mysqli_query($con, "SELECT * FROM police where adminc='no'");
  ?>
  <table class="clist table table-striped table-bordered" align="center" border="1">
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
      <td>Approval</td>
      <td>Rejection</td>
      

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
        <td><a class="appbtn1" href="admin.php?id=<?=$row['policeid']?>">Accept</a></td>
        <td><a class="appbtn2" href="admin.php?rid=<?=$row['policeid']?>">Reject</a></td>
</td>

      </tr>
      <?php endforeach; ?>
    </table>
   

</body>
</html>