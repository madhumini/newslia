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
    <link rel="stylesheet" href="../css/Tables.css">
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

<?php $page = 'blacklist';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->

<!--Admin Page Content -->

<?php
echo "<form action='./Blacklist.php' method='POST' class = 'complaint_list'>";
?>

<div class="title"><center><h3>BLACKLIST</h3></center></div>
<div class="content">
<table>
 <tr><th>ID</th><th>Username</th><th>Divisional Secreterate Area</th><th>NIC</th><th>Mobile number</th><th></th></tr>
 <?php

  include '../Model/connect.php';
    

  $blacklist_sql = "SELECT * FROM login WHERE Blacklist = 1";

  $blacklist_state = $conn->query($blacklist_sql);

  $blacklist_results = $blacklist_state->fetchAll(PDO::FETCH_ASSOC);

  if ($blacklist_results){
    foreach($blacklist_results as $blacklist_result){

      $ID = $blacklist_result['System_Actor_ID'];

      $blacklist_info_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$ID')";

      $blacklist_info_state = $conn->query($blacklist_info_sql);

      $blacklist_info_results = $blacklist_info_state->fetchAll(PDO::FETCH_ASSOC);

      if ($blacklist_info_results){
        foreach($blacklist_info_results as $blacklist_info_result){
          echo "<tr>
          <td>".$blacklist_info_result['System_Actor_Id']."</td>
          <td>".$blacklist_info_result['UserName']."</td>
          <td>".$blacklist_info_result['DSA']."</td>
          <td>".$blacklist_info_result['NIC']."</td>
          <td>".$blacklist_info_result['Mobile']."</td>
          <td>
              <form action='./Blacklist.php' method='POST'>
                 <input type='hidden' name='ID' value=".$blacklist_info_result['System_Actor_Id']." > 
                 <input type='submit' name='remove_blacklist' class='remove' value = 'Remove'>
              </form>

          </td>
         </tr>";
       

        }
      }

    }
  }



 

 
?>




</table>
 
</form>
</div>


<?php
  
  if(isset($_POST['remove_blacklist'])){
      
      $UserID = $_POST['ID'];
     
      $systemuser =[
        'id' => $UserID,
        'active' => 0
      ];

      $sql = 'UPDATE login
            SET Blacklist = :active
            WHERE System_Actor_ID = :id';
    
      $statement = $conn->prepare($sql);
      $statement->bindParam(':id', $systemuser['id']);
      $statement->bindParam(':active', $systemuser['active']);

      $statement->execute();

      $reporterinfo =[
        'id' => $UserID,
        'Complaints' => '0',
        'Stars' => '0'
      ];

      $sql = 'UPDATE reporter_insights
            SET Complaints = :Complaints
            WHERE System_Actor_Id  = :id';
    
      $statement = $conn->prepare($sql);
      $statement->bindParam(':id', $reporterinfo['id']);
      $statement->bindParam(':Complaints', $reporterinfo['Complaints']);
      $statement->execute();
        
      $sql = 'UPDATE reporter_insights
            SET Stars = :Stars 
            WHERE System_Actor_Id  = :id';
    
      $statement = $conn->prepare($sql);
      $statement->bindParam(':id', $reporterinfo['id']);
      $statement->bindParam(':Stars', $reporterinfo['Stars']);
      $statement->execute();


      echo "<script>window.open('./Blacklist.php','_self')</script>";

  }

?>

</body>
</html>