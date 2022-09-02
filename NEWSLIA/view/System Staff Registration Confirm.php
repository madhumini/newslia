<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator_Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/insight.css">
    <link rel="stylesheet" href="../css/System Staff Registration Confirm.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
</head>

<style>
  body {
  overflow: scroll; /* Hide scrollbars */
  }
</style>

<body>

  <!--navigation-->

<?php $page = 'view';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


<div class="body_form">

  </div>

  <div class="main_title"><h3>MODERATOR REGISTRATION</h3></div>
  <div class="form_1">


        <div class="title_"><h3>Personal Information</h3><br></div>
        

        <?php
            echo "<form action='./System Staff Registration Confirm.php' method='post'>";
            include '../model/connect.php';
            $ID = $_SESSION['STAFF_MEMBER'];
            $email = $_SESSION['STAFF_MEMBER_EMAIL'];

            $staff_moderaotor_sql = "SELECT * FROM system_actor WHERE System_Actor_Id = '$ID'";
            $staff_moderaotor_statement = $conn -> query($staff_moderaotor_sql);
            $staff_moderaotor_results = $staff_moderaotor_statement->fetchAll(PDO::FETCH_ASSOC);

            if($staff_moderaotor_results){
              foreach($staff_moderaotor_results as $staff_moderaotor_result){
                
                $DSA = $staff_moderaotor_result['DSA'];

                $staff_dsa_sql = "SELECT * FROM dsa WHERE DSA = '$DSA'";
                $staff_dsa_statement = $conn -> query($staff_dsa_sql);
                $staff_dsa_results = $staff_dsa_statement->fetchAll(PDO::FETCH_ASSOC);

                if($staff_dsa_results){
                  foreach($staff_dsa_results as $staff_dsa_result){
                    $_SESSION['province'] = $staff_dsa_result['Province'];
                    $_SESSION['district'] = $staff_dsa_result['District'];
                    
                  }
                }

              $province =  $_SESSION['province'];
              $district =  $_SESSION['district'];
            
              echo "
              <label for='fname' class='label'>First name</label>
              <input type='text' id='fname' name='moderator_fname' value= '".$staff_moderaotor_result['FirstName']."' class='input_fields' disabled>

              
              <label for='lname' class='label'>Last name</label>
              <input type='text' id='lname' name='moderator_lname' value='".$staff_moderaotor_result['LastName']."' class='input_fields' disabled><br><br>

              <label for='Email' class='label'>Email Address</label>
              <input type='email' id='Email' name='moderator_email' value='".$email."' class='input_fields' disabled>

              <label for='Mobile' class='label'>Mobile Number</label>
              <input type='text' id='Mobile' name='moderator_mobile' value='".$staff_moderaotor_result['Mobile']."' class='input_fields' disabled> <br><br>

              <label for= 'NIC' class='label'>NIC Number</label>
              <input type='text' id='NIC' name='moderator_NIC' value='".$staff_moderaotor_result['NIC']."' class='input_fields' disabled>


              
              <label for='province' class='label'>Province</label>
              <input type='text' id='province' name='moderator_province' value='".$province."' class='input_fields' disabled><br><br>


              <label for='distict' class='label'>District</label>
              <input type='text' id='distict' name='moderator_district' value='".$district."' class='input_fields' disabled>


              <label for='dsa' class='label'>Divisional Secretariat Area</label>
              <input type='text' id='dsa' name='moderator_dsa' value='".$staff_moderaotor_result['DSA']."' class='input_fields' disabled><br><br>


              <label for='experiance' class='label'>Expereiance</label>
              <input type='text' id='experiance' name='experiance' value='".$staff_moderaotor_result['Experiance']."' class='input_fields' disabled>
              ";
            
              }
            }
         ?>


       
</div>
    
  <div class="buttons">
      <button class="accept_button" name = "accept">Accept</button>
      
      <button class="reject_button" name = "reject">Reject</button>
  </div>

  </form>


  <?php

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['accept'])){
      include '../model/connect.php';
      $email = $_SESSION['STAFF_MEMBER_EMAIL'];

     
    $sql = "UPDATE login
            SET Staff_State = '1'
            WHERE Email = '$email'";
    
    $statement = $conn->prepare($sql);
    

    if ($statement->execute()) {

      //the subject
      $sub = "Registration Confirmation Email";
      //the message
      $msg = "Dear Sir/Madam,

      Thank you for completing your registration with the Moderator.

      This email serves as a confirmation that your account is activated and that you are officially a part of the NEWSLIA family.
      Enjoy!

      Regards,
      The NEWSLIA team.
      ";

      //send email
      $send_result = mail($email,$sub,$msg);

      /*if($send_result){
        echo '<script>alert("work")</script>';
      }
      else{
        echo '<script>alert("Not work")</script>';
      }*/

      echo '<script type="text/javascript">window.open("./Staff_Registration_Moderator.php", "_self");</script>';
    }
  }


    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['reject'])){
      include '../model/connect.php';
      $ID = $_SESSION['STAFF_MEMBER'];

     
    $sql = "DELETE FROM system_actor WHERE System_Actor_Id = '$ID'";
    
    $statement = $conn->prepare($sql);
    

    if ($statement->execute()) {
      echo '<script type="text/javascript">window.open("./Staff_Registration_Moderator.php", "_self");</script>';
    }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  ?>

</body>
</html>