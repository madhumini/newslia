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
  echo "<form action='./Reporter Details.php' method='post' class = 'complaint_list'>";
?>

  <div class="title"><center><h3>REPORTER DETAILS</h3></center></div>
  <div class="content">
  <table>
 <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Divisional Secreterate Area</th><th>NIC</th><th>Mobile No</th><th>Email</th><th>Reading Area</th><th>Reporting Area</th><th></th><th></th></tr>
 
 <?php
  
    $reporter_user_sql = "SELECT * FROM system_actor WHERE Position  = 'R' ";

    $reporter_user_state = $conn->query($reporter_user_sql);

    $reporter_user_results = $reporter_user_state->fetchAll(PDO::FETCH_ASSOC);

    if ($reporter_user_results){
      foreach($reporter_user_results as $reporter_user_result){

        $ID = $reporter_user_result['System_Actor_Id'];

        $reporter_info_sql = "SELECT * FROM login WHERE (System_Actor_ID = '$ID')";

        $reporter_info_state = $conn->query($reporter_info_sql);

        $reporter_info_results = $reporter_info_state->fetchAll(PDO::FETCH_ASSOC);

        if ($reporter_info_results){
          foreach($reporter_info_results as $reporter_info_result){
            echo "<tr>
            <td>".$ID."</td>
            <td>".$reporter_user_result['FirstName']."</td>
            <td>".$reporter_user_result['LastName']."</td>
            <td>".$reporter_user_result['DSA']."</td>
            <td>".$reporter_user_result['NIC']."</td>
            <td>".$reporter_user_result['Mobile']."</td>
            <td>".$reporter_info_result['Email']."</td>

            <td>";

            $reporter_read_info_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$ID')";

            $reporter_read_info_state = $conn->query($reporter_read_info_sql);
      
            $reporter_read_info_results = $reporter_read_info_state->fetchAll(PDO::FETCH_ASSOC);
      
            if ($reporter_read_info_results){
              foreach($reporter_read_info_results as $reporter_read_info_result){

                echo " ".$reporter_read_info_result['Area']."\t";

              }
            }
            
            
            echo "</td>
            <td>";
              $reporter_reporte_info_sql = "SELECT * FROM report_area WHERE (System_Actor_Id = '$ID')";

              $reporter_reporte_info_state = $conn->query($reporter_reporte_info_sql);
        
              $reporter_reporte_info_results = $reporter_reporte_info_state->fetchAll(PDO::FETCH_ASSOC);
        
              if ($reporter_reporte_info_results){
                foreach($reporter_reporte_info_results as $reporter_reporte_info_result){

                  echo " ".$reporter_reporte_info_result['Area']."\t";

                }
              }



            echo "
              <td><form action='./Reporter Details.php' method='POST'>
                      <input type='hidden' name='ID' value=".$ID." > 
                      <input type='hidden' name='Email' value=".$reporter_info_result['Email']." > 
                      <input type='hidden' name='FNAME' value=".$reporter_user_result['FirstName']." > 
                      <input type='hidden' name='LNAME' value=".$reporter_user_result['LastName']." >  
             
                      <input type='submit' name='remove_reporter' value='Remove' class='remove'>
                  </form>
            </td>
          </tr>";
        

          }
        }

      }
    }




 ?>


<?php
  if(isset($_POST['remove_reporter'])){
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


        echo "<script>window.open('./Reporter Details.php','_self')</script>";
    }
   
  }

?>


</table>



</form>
</div>
</body>
</html>