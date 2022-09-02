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
  include 'nav.php'; 
?>

<!--End of Navigation-Bar-->



<!--Admin Page Content -->
<?php
  echo "<form action='./Moderator Details.php' method='post' class = 'complaint_list'>";
            
?>


<div class="title"><center><h3>MODERATOR DETAILS</h3></center></div>
  <div class="content">
  <table>
 <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Divisional Secreterate Area</th><th>Mobile No</th><th>Email</th><th>Experiance</th><th>Moderating Area</th><th>Reading Area</th><th></th><th></th></tr>

 <?php
  
  $moderator_user_sql = "SELECT * FROM system_actor WHERE Position  = 'M' ";

  $moderator_user_state = $conn->query($moderator_user_sql);

  $moderator_user_results = $moderator_user_state->fetchAll(PDO::FETCH_ASSOC);

  if ($moderator_user_results){
    foreach($moderator_user_results as $moderator_user_result){

      $ID = $moderator_user_result['System_Actor_Id'];

      $moderator_info_sql = "SELECT * FROM login WHERE (System_Actor_ID = '$ID')AND Staff_State='1'";

      $moderator_info_state = $conn->query($moderator_info_sql);

      $moderator_info_results = $moderator_info_state->fetchAll(PDO::FETCH_ASSOC);

      if ($moderator_info_results){
        foreach($moderator_info_results as $moderator_info_result){
          echo "<tr>
          <td>".$ID."</td>
          <td>".$moderator_user_result['FirstName']."</td>
          <td>".$moderator_user_result['LastName']."</td>
          <td>".$moderator_user_result['DSA']."</td>
         
          <td>".$moderator_user_result['Mobile']."</td>
          <td>".$moderator_info_result['Email']."</td>
          <td>".$moderator_user_result['Experiance']."</td>

          <td>";

          $moderator_read_info_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$ID')";

          $moderator_read_info_state = $conn->query($moderator_read_info_sql);
    
          $moderator_read_info_results = $moderator_read_info_state->fetchAll(PDO::FETCH_ASSOC);
    
          if ($moderator_read_info_results){
            foreach($moderator_read_info_results as $moderator_read_info_result){

              echo " ".$moderator_read_info_result['Area']."\t";

            }
          }
          
          
          echo "</td>
          <td>";
            $moderator_moderate_info_sql = "SELECT * FROM moderate_area WHERE (System_Actor_Id = '$ID')";

            $moderator_moderate_info_state = $conn->query($moderator_moderate_info_sql);
      
            $moderator_moderate_info_results = $moderator_moderate_info_state->fetchAll(PDO::FETCH_ASSOC);
      
            if ($moderator_moderate_info_results){
              foreach($moderator_moderate_info_results as $moderator_moderate_info_result){

                echo " ".$moderator_moderate_info_result['Area']."\t";

              }
            }



          echo "
             <td>
                <form action='./Moderator Details.php' method='POST'>
                    <input type='hidden' name='ID' value=".$ID." > 
                    <input type='hidden' name='Email' value=".$moderator_info_result['Email']." > 
                    <input type='hidden' name='FNAME' value=".$moderator_user_result['FirstName']." > 
                    <input type='hidden' name='LNAME' value=".$moderator_user_result['LastName']." >
                    <input type='hidden' name='LNAME' value=".$moderator_user_result['Experiance']." >  
                    <input type='submit' name='remove_moderator' value='Remove' class='remove'>
                </form>
            </td>
         </tr>";
       

        }
      }

    }
  }




 ?>



<?php
  if(isset($_POST['remove_moderator'])){
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

        echo "<script>window.open('./Moderator Details.php','_self')</script>";
    }
   
  }

?>


</table>
</form>
</div>
</body>
</html>

