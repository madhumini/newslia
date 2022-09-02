<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/complaint_tables.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">


</head>

<style>
   .complaint_list{
      margin-top:3rem;
  }

  .content{
    margin-top:1rem;
  }
</style>



<body>


<!--navigation-->

<?php $page = 'insights';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->

  
<!--Admin Page Content -->
<form action="../Control/complaint_control.php" method="post" class = "complaint_list">


<div class="title"><center><h3>ACCEPTED COMPLAINTS</h3></center></div>
  <div class="content">
  <table>
  <tr><th>News_ID</th><th>Date</th><th>Complainer_ID</th><th>Details</th><th></th><th></th></tr>

 <?php
 include '../model/connect.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $sql = 'select * from accept_complaint';

    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<?php while ($row = $q->fetch()): ?>           

  <tr>
   <td><?php echo $row['News_ID']; ?></td>
   <td><?php echo $row['date']; ?></td>
   <td> <?php echo $row['Complainer_ID'] ?></td>
   <td><textarea rows="3" cols="40" disabled class="input1" id="description" name="Details" ><?php echo $row['Details']; ?></textarea></td>
 </tr>




<?php endwhile; ?>
</table>
</form>
</div>
</body>
</html>

