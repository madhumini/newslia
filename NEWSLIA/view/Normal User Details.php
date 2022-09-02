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

 <?php $page = 'normal_user';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!--Admin Page Content -->
<?php

echo "<form action='./Normal User Details.php' method='POST' class = 'complaint_list'>";
include '../Model/connect.php';
?>

  <div class="title"><center><h3>NORMAL USER DETAILS</h3></center></div>
  <div class="content">
  <table>
 <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Divisional Secreterate Area</th><th>NIC</th><th>Mobile No</th><th>Email</th><th>Reading Area</th><th></th><th></th></tr>
 <?php
  
  $normal_user_sql = "SELECT * FROM system_actor WHERE Position  = 'N' ";

  $normal_user_state = $conn->query($normal_user_sql);

  $normal_user_results = $normal_user_state->fetchAll(PDO::FETCH_ASSOC);

  if ($normal_user_results){
    foreach($normal_user_results as $normal_user_result){

      $ID = $normal_user_result['System_Actor_Id'];

      $normal_user_info_sql = "SELECT * FROM login WHERE (System_Actor_ID = '$ID')";

      $normal_user_info_state = $conn->query($normal_user_info_sql);

      $normal_user_info_results = $normal_user_info_state->fetchAll(PDO::FETCH_ASSOC);

      if ($normal_user_info_results){
        foreach($normal_user_info_results as $normal_user_info_result){
          echo "<tr>
          <td>".$ID."</td>
          <td>".$normal_user_result['FirstName']."</td>
          <td>".$normal_user_result['LastName']."</td>
          <td>".$normal_user_result['DSA']."</td>
          <td>".$normal_user_result['NIC']."</td>
          <td>".$normal_user_result['Mobile']."</td>
          <td>".$normal_user_info_result['Email']."</td>

          <td>";

          $normal_user_read_info_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$ID')";

          $normal_user_read_info_state = $conn->query($normal_user_read_info_sql);
    
          $normal_user_read_info_results = $normal_user_read_info_state->fetchAll(PDO::FETCH_ASSOC);
    
          if ($normal_user_read_info_results){
            foreach($normal_user_read_info_results as $normal_user_read_info_result){

              echo " ".$normal_user_read_info_result['Area']."\t";

            }
          }
          
          
          echo "</td>

          <td>
          <form action='./Normal User Details.php' method='POST'>
             <input type='hidden' name='ID' value=".$ID." > 
             <input type='hidden' name='Email' value=".$normal_user_info_result['Email']." >
             <input type='hidden' name='FNAME' value=".$normal_user_result['FirstName']." > 
             <input type='hidden' name='LNAME' value=".$normal_user_result['LastName']." >  
             <input type='submit' name='remove_normal_user' value='Remove' class='remove'>
          </form>
          </td>
         </tr>";
       

        }
      }

    }
  }




 ?>


<?php
  if(isset($_POST['remove_normal_user'])){
    $ID = $_POST['ID'];
    $Email = $_POST['Email'];
    $FNAME = $_POST['FNAME'];
    $LNAME = $_POST['LNAME'];
  
    $sql = 'DELETE FROM system_actor WHERE System_Actor_Id = :System_Actor_Id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':System_Actor_Id', $ID); 
    
    if($statement->execute()){
        //the subject
        $sub = "Delete The Account";
        //the message
        $msg = "Dear Sir/Madam,

        Your account has been deleted. Due to some reasons. 
        
        Thank you for join with us.

        Regards,
        The NEWSLIA team.
        ";

        //send email
        $send_result = mail($Email,$sub,$msg);
        
        $read_stmt = $conn->prepare("INSERT INTO `system_actor` (`System_Actor_Id`,`FirstName`,`LastName`) VALUES(?,?,?)");
        $read_stmt->execute([$ID,$FNAME,$LNAME]);

        echo "<script>window.open('./Normal User Details.php','_self')</script>";
    }
   
  }

?>

</table>
</form>
</div>
</body>
</html>