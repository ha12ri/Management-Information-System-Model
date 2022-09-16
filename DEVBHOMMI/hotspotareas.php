<html>
  <head>
    <link rel="stylesheet" href="./welcome_police.css">
  </head>
<body>



<?php
require_once('connection.php');
$query = "select crimecity, count(*) as cnt from userfir group by crimecity HAVING cnt > 5";
$rows=mysqli_query($con, $query);
?>

<table class="clist" align="center" border="1">
  <tr>
    <td>Serial No.</td>
    <td>Hotspot Location</td>
    <td>Total Registered Cases</td>
  </tr>

  <?php $i = 1; ?>
  <?php foreach($rows as $row) : ?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $row["crimecity"]; ?></td>
      <td><?php echo $row["cnt"] ?></td>
    </tr>
  <?php endforeach; ?>
</table>


</body>
</html>


