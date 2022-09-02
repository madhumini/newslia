<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSLIA</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/select_area.css">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
   
</head>

<style>
  body {
    /*overflow: hidden; /* Hide scrollbars */
  }

  .inp1{
      width:12rem;
      margin-left:1.2rem;
      padding-left:5px;
  }

  .update_btn{
      border: none;
      width:3rem;
      margin-top:0.5rem;
      transition: 0.25s ease;
      box-shadow: none;
  }

  .update_btn:hover{
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.25);
    transform:scale(1.12);
  }

  .popup_update .popup_update_content{
    height:250px;
  }

  .otp_btn2{
    width:6rem;
    height:2rem;
    padding:0.1rem;
    font-size:13px;
    margin-left:4rem;
    margin-top:1rem;
  }


  .column2 {
    float: right;
    width: 82%;
    height: 557px;
    margin-top:-44rem;
  }

  .prof_img{
      margin-top:-0.5rem;
  }

  .prof_img img {
    position: relative;
    left: 30%;
    top: -280%;
  }

  .prof_img h3 {
    position: relative;
    left: 38%;
    margin-top: -1%;
    margin-left: -50px;
    font-style: normal;
    font-weight: bold;
    font-size: 17px;
    line-height: 21px;
  }
  
  
  .columns_below2 {
    position: relative;
    width: 50%;
    float: right;
    margin-top: -7%;
    top: -349px;
  }

  .columns_below1 {
    position: relative;
    width: 50%;
    float: left;
    padding: 30px 40px;
    margin-top: -3%;
  }

    .formp1 {
    display: flex;
    flex-direction: column;
    padding: 0px 40px;
  }

  .part {
    margin: 20px 0px;
  }

  .label {
    margin-bottom: 10px;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 18px;
    color: #565555;
  }

  .ans {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 16px;
    padding-left: 22px;
  }

  .part hr {
    margin-left: 4px;
    width: 90%;
  }

  .part img {
    position: relative;
    height: 25px;
    width: 15px;
    float: right;
    right: 50px;
    /* right: 44.1%; */
    /* top: 66.14%;
bottom: 31.43%; */
  }

  .camera {
    background-color: #E3E3E3;
    position: relative;
    width: 32px;
    height: 32px;
    left: 590px;
    top: -70px;
  }

  .fa-camera:before {
    content: "\f030";
    color: black;
  }

  .column1 tr:hover {
    background-color: #f1f1f1;
  }

  .profile-pen {

    position: relative;
    height: 25px;
    width: 15px;
    float: right;
    right: 50px;
    /* right: 44.1%; */

  }

  .fa-pen:before {
    content: "\f304";
    color: black;
  }

  .popup_add_new_size .content_add_new_size{
    height:420px;
  }

  .message {
      display:block;
      background: #f1f1f1;
      color: #000;
      width: 80%;
      position: relative;
      padding: 5px;
      margin-top: 10px;
      top:-12rem;
      left:9rem;
      border-radius: 10px;
    }

  .message::before{
    content: "";
    position: absolute;
    right: 100%;
    top: 7px;
    width: 0;
    height: 0;
    border-top: 13px solid transparent;
    border-right: 26px solid #f1f1f1;
    border-bottom: 13px solid transparent;
    }

  .message p {
    padding: 5px 5px;
    width:100%;
    font-size: 13px;
   }

  #msg1{
    display:none;
    top:-2.8rem;
    left:15rem;
  }

  .req1{
    position: relative;
    top:-4.2rem;
  }

  #msg2{
    display:none;
    padding:1rem;
    top:-2.6rem;
    left:15rem;
  }

  .req2{
    position: relative;
    top:-13.2rem;
  }

  #msg3{
    display:none;
    padding:1rem;
    top:-2.6rem;
    left:15rem;
  }

  .req3{
    position: relative;
    top:-6rem;
  }

  /* Add a green text color and a checkmark when the requirements are right */
  .valid {
    color: green;
    }

  .valid:before {
     position: relative;
     left: -4px;
     content: "✔";
    }

  /* Add a red text color and an "x" when the requirements are wrong */
  .invalid {
    color: red;
    }

  .invalid:before {
    position: relative;
    left: -4px;
    content: "✖";
  }
</style>


<body>

 

<!--navigation-->

<?php $page = 'home';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!-- Moderator Notices View -->


<div class="left_side">

  <div class="icon_left_side">

  <li><a href="Moderator_Profile.php"><img src="../images/other/profile.png" alt="" srcset=""><p style="color: #45ADA8EB;">My Profile</p></a></li>
  
  <?php
      if($_SESSION['Actor_Type'] != "ADMIN"){
        echo "<li><a href='Moderate_Area.php'><img src='../images/other/location.png'><p>Select Area</p></a></li>";
      }
  ?>

  <li><a href="Moderate_Post_Type.php"><img src="../images/other/type.png" alt="" srcset=""><p>Select Type</p></a></li>
  
  <?php
      if($_SESSION['Actor_Type'] != "NORMALUSER" and $_SESSION['Actor_Type'] != "ADMIN"){
          echo "<li><a href='Moderator_Insight.php'><img src='../images/other/insights.png'><p>Insights</p></a></li>";
                }
  ?>
  
  <li onclick="togglePopup_select_option('deactivate-1')"><a href="#"><img src="../images/other/deactivate.png" alt="" srcset=""><p>Deactivate</p></a></li>
  <li><a href="logout.php"><img src="../images/other/logout.png" alt="" srcset=""><p>Log Out</p></a></li>



  </div>


</div>




<div class="column2">

<div class="prof_img">
<?php

include '../Model/connect.php';
$Moderator_ID = $_SESSION['System_Actor_ID'];

$moderator_profile_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$Moderator_ID')";
$moderator_profile_statement = $conn -> query($moderator_profile_sql);
$moderator_profile_results = $moderator_profile_statement->fetchAll(PDO::FETCH_ASSOC);


if($moderator_profile_results){
  foreach($moderator_profile_results as $moderator_profile_result){

      $first = $moderator_profile_result['FirstName'];
      $last = $moderator_profile_result['LastName'];
      $DSA = $moderator_profile_result['DSA'];
      $Mobile = $moderator_profile_result['Mobile'];
      $NIC = $moderator_profile_result['NIC'];
      $UserName = $moderator_profile_result['UserName'];

      $img = $moderator_profile_result['Profile_Img'];
      $img = base64_encode($img);
      $text = pathinfo($moderator_profile_result['System_Actor_Id'], PATHINFO_EXTENSION);

  }
}


$email_pwd_profile_sql = "SELECT * FROM login WHERE (System_Actor_Id = '$Moderator_ID')";
$email_pwd_profile_statement = $conn -> query($email_pwd_profile_sql);
$email_pwd_profile_results = $email_pwd_profile_statement->fetchAll(PDO::FETCH_ASSOC);


if($email_pwd_profile_results){
  foreach($email_pwd_profile_results as $email_pwd_profile_result){

      $email = $email_pwd_profile_result['Email'];
      $pwd = $email_pwd_profile_result['Password'];
      
  }
}

if($img != NULL){
  echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(0.7);margin-top:-2rem;border-radius:10%;'>";
  echo  "<h3>".$first." ".$last."</h3>";
}
else{
  echo "<img src='../images/Profile.svg' style='transform:scale(2);margin-left:10rem; margin-bottom:3rem; margin-top:1rem;'>";
  echo  "<h3 style='margin-left:2rem;'>".$first." ".$last."</h3>";
}



?>

<a href="#" class="camera" onclick="togglePopupupdate_remove()"><i class="fas fa-camera fa-2x"></i></a>
  <hr style="margin-top:0px;margin-left: 30px;">
</div>

<div class="columns_below1">
  <div class="formp1" style="padding: 0px 40px;">

    <div class="part">
      <p class="label">First Name</p>
      <p class="ans"><?=$first;?> <a href="#" class="profile-pen" onclick="togglePopup_firstname()"> <i class="fas fa-pen"></i> </a></p>
      <hr>
    </div>
  
    <div class="part">
      <p class="label">Last Name</p>
      <p class="ans"> <?=$last;?> <a href="#" class="profile-pen" onclick="togglePopup_lastname()"> <i class="fas fa-pen"></i> </a> </p>
      <!-- <img src="images/pen.svg"> -->
      <hr>
    </div>
  
    <div class="part">
      <p class="label">Divisional Secretariat Area</p>
      <p class="ans"><?=$DSA;?> <a href="#" class="profile-pen"> <i class="fas fa-pen" style="display:none;"></i> </a> </p>
      <!-- <img src="images/pen.svg"> -->
      <hr>
    </div>
  
    <div class="part">
      <p class="label">Mobile No.</p>
      <p class="ans"><?=$Mobile;?> <a href="#" class="profile-pen" onclick="togglePopup_mobile()"> <i class="fas fa-pen"></i> </a> </p>
      <hr>
    </div>
  
  </div>
</div>

<div class="columns_below2">
  <div class="formp1" style="padding: 35px 45px;">
    <div class="part">
      <p class="label">NIC No.</p>
      <p class="ans"> <?=$NIC;?> <a href="#" class="profile-pen"> <i class="fas fa-pen" style="display:none;"></i> </a> </p>
      <hr>
    </div>
    <div class="part">
      <p class="label">Email</p>
      <p class="ans"> <?=$email;?> <a href="#" class="profile-pen"> <i class="fas fa-pen" style="display:none;"></i> </a> </p>
      <!-- <img src="images/pen.svg"> -->
      <hr>
    </div>
    <div class="part">
      <p class="label">User Name</p>
      <p class="ans"><?=$UserName;?> <a href="#" class="profile-pen"> <i class="fas fa-pen" style="display:none;"></i> </a> </p>
      <!-- <img src="images/pen.svg"> -->
      <hr>
    </div>
    <div class="part">
      <p class="label">Password</p>
      <p class="ans" onclick = "togglePopup_pwd()"> <input type="password" name="" id="" placeholder="Reset Your Password in Here.." style="width:420px;border:none;" disabled> <a href="#" class="profile-pen"> <i class="fas fa-pen"></i> </a> </p>
      <!-- <img src="images/pen.svg"> -->
      <hr>
    </div>
  </div>
</div>

</div>

</div>




<div class="errorbox" id="error1">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Invalid Mobile Number</div>
       <div class="error_foot" onclick="mobile_error()">OK</div>

  </div>
</div>

<div class="errorbox" id="error2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Confirm Password confirmation does not match.</div>
       <div class="error_foot" onclick="pwd_not_match()">OK</div>

  </div>
</div>

<div class="errorbox" id="error3">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Password must be at least 8 characters.</div>
       <div class="error_foot" onclick="pwd_length()">OK</div>

  </div>
</div>


<div class="popup popup_update" id="popup-1">

    <div class="overlay"></div>

          <div class="content popup_update_content">
        <div class="close-btn" onclick="togglePopup_firstname()">&times;</div>
        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Update First Name</h3>
                <div name="login_form">

                  <form action='Moderator_Profile.php' method='POST'>
                      <input type='text' name='sysactor_new_first' class='inp inp1' placeholder='Enter First Name' required>
                      <br>
                    
                      <input type='submit' value='Save' class='update_btn otp_btn2' name = 'update_fname'>

                  </form>

                  <br> 
            </div>
            </div>
        </div>
    </div>
</div>

<div class="popup popup_update" id="popup-2">

    <div class="overlay"></div>

          <div class="content popup_update_content">
        <div class="close-btn" onclick="togglePopup_lastname()">&times;</div>
        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Update Last Name</h3>
                <div name="login_form">
                
                <form action='Moderator_Profile.php' method='POST'>
                  <input type='text' name='sysactor_new_last' class='inp inp1' placeholder='Enter Last Name' required>
                  <br>
                 
                  <input type='submit' value='Save' class='update_btn otp_btn2' name = 'update_lname'>
                </form>
                  <br> 
            </div>
            </div>
        </div>
    </div>
</div>

<div class="popup popup_update" id="popup-3">

    <div class="overlay"></div>

          <div class="content popup_update_content">
        <div class="close-btn" onclick="togglePopup_mobile()">&times;</div>
        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Update Mobile Number</h3>
                <div name="login_form">
                  
                  <form action='Moderator_Profile.php' method='POST'>
                    <input type='text' name='sysactor_new_mobile' id="new_mobile" class='inp inp1' placeholder='Enter Mobile Number' required>
                    
                    <div class="message" id="msg1">
                      <p id="mobile_check" class="invalid">Mobile Number</p>
                    </div> 

                    <br>
                  
                    <input type='submit' value='Save' class='update_btn otp_btn2' name = 'update_mobile' id="mobile_check_btn" >
                  </form>
                  
                  <br> 
            </div>
            </div>
        </div>
    </div>
</div>


<div class="popup popup_forget" id="popup-4">

    <div class="overlay"></div>

          <div class="content popup_forget_content">
        <div class="close-btn" onclick="togglePopup_pwd()">&times;</div>
        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Reset Password</h3>
                <div name="login_form">

                <form action='Moderator_Profile.php' method='POST'>
                  <input type="password" name="sysactor_new_pwd_1" class="inp inp1" id = "rest_pwd_1" placeholder="New Password" required>

                        <div class="message" id="msg2">
                            <h4>Password must contain the following:</h4>
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>

                  <br>
                  <br>
                  
                  <input type="password" name="sysactor_new_pwd_2" class="inp inp1" id = "rest_pwd_2" placeholder="Retype New Password" required>
                      
                        <div class="message" id="msg3">
                            <p id="confirmation" class="invalid">password confirmation match.</p>
                        </div> 
                  <br>
                  
                  <input type='submit' value='Save' class='update_btn otp_btn2' name = 'update_pwd' id = "rest_pwd_btn">
                </form>

                  <br>
                  <br> 
            </div>
            </div>
        </div>
    </div>
</div>



<script>
    var new_mobile = document.getElementById("new_mobile");
    var mobile_check = document.getElementById("mobile_check");

    var new_pwd = document.getElementById("rest_pwd_1");
    var re_new_pwd = document.getElementById("rest_pwd_2");

    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var confirmation = document.getElementById("confirmation");

    // Mobile Number Validation
        /*new_mobile.onfocus = function(){
            document.getElementById("msg1").style.display = "block";
            document.getElementById("mobile_check_btn").classList.add("req1");
        }*/

        new_mobile.onblur = function(){
            document.getElementById("msg1").style.display = "none";
            document.getElementById("mobile_check_btn").classList.remove("req1");
        }

        // When the user starts to type something inside the mobile field
        new_mobile.onkeyup = function(){
           document.getElementById("msg1").style.display = "block";
            document.getElementById("mobile_check_btn").classList.add("req1");
            const mobileformat = /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$/;                  
            if(mobileformat.exec(new_mobile.value)) {  
                mobile_check.classList.remove("invalid");
                mobile_check.classList.add("valid");
            } else {
                mobile_check.classList.remove("valid");
                mobile_check.classList.add("invalid");
            }
          }


    // Password Validation
        
        /*new_pwd.onfocus = function(){
            document.getElementById("msg2").style.display = "block";
            document.getElementById("rest_pwd_2").classList.add("req2");
            document.getElementById("rest_pwd_btn").classList.add("req2");
        }*/ 

        new_pwd.onblur = function(){
            document.getElementById("msg2").style.display = "none";
            document.getElementById("rest_pwd_2").classList.remove("req2");
            document.getElementById("rest_pwd_btn").classList.remove("req2");
        } 

        /*re_new_pwd.onfocus = function(){
            document.getElementById("msg3").style.display = "block";
            document.getElementById("rest_pwd_btn").classList.add("req3");
        }*/ 

        re_new_pwd.onblur = function(){
            document.getElementById("msg3").style.display = "none";
            document.getElementById("rest_pwd_btn").classList.remove("req3");
        } 

        // When the user starts to type something inside the confirmation password field
        re_new_pwd.onkeyup = function(){
            document.getElementById("msg3").style.display = "block";
            document.getElementById("rest_pwd_btn").classList.add("req3");
              if(re_new_pwd.value == new_pwd.value) {  
                confirmation.classList.remove("invalid");
                confirmation.classList.add("valid");
              } else {
                confirmation.classList.remove("valid");
                confirmation.classList.add("invalid");
              }
          }

    
        // When the user starts to type something inside the password field
        new_pwd.onkeyup = function() {
              document.getElementById("msg2").style.display = "block";
              document.getElementById("rest_pwd_2").classList.add("req2");
              document.getElementById("rest_pwd_btn").classList.add("req2");
              var lowerCaseLetters = /[a-z]/g;
              if(new_pwd.value.match(lowerCaseLetters)) {  
                letter.classList.remove("invalid");
                letter.classList.add("valid");
              } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
              }
              
              // Validate capital letters
              var upperCaseLetters = /[A-Z]/g;
              if(new_pwd.value.match(upperCaseLetters)) {  
                capital.classList.remove("invalid");
                capital.classList.add("valid");
              } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
              }

              // Validate numbers
              var numbers = /[0-9]/g;
              if(new_pwd.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
              } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
              }
              
              // Validate length
              if(new_pwd.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
              } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
              }
            }

  </script>




<div class="popup popup_update_img" id="popup-5">

      <div class="overlay"></div>

      <div class="content content_add_new" id="popup-5-content">
          <div class="close-btn" onclick="togglePopupupdate_remove()">&times;</div>


          <div class="content_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Update Profile Picture</h3>
                  
                  <form action="Moderator_Profile.php" method="POST" enctype="multipart/form-data">
                    
                        <div class="center_img">
                            <div class="form-input_img">
                              <label for="file-ip-2">Upload Image</label>
                              <input type="file" id="file-ip-2" name="update_upload" accept="image/*" onchange="showPreview_2(event);" required>
                              <div class="preview_img">
                              <img id="file-ip-2-preview">
                            </div>
                       </div>

              </div>
            </div>
                <button class="update_btn insert_btn" name="update_profile" style="margin-top:10px;">Save</button>
                </form>

               </div>

          </div>
      </div>
      
</div>






<script>


    function mobile_error(){
      document.getElementById("error1").classList.toggle("active");
    }

    function pwd_not_match(){
      document.getElementById("error2").classList.toggle("active");
    }

    function pwd_length(){
      document.getElementById("error3").classList.toggle("active");
    }

    function togglePopup_firstname(){
        document.getElementById("popup-1").classList.toggle("active");
    }

    function togglePopup_lastname(){
        document.getElementById("popup-2").classList.toggle("active");
    }

    function togglePopup_mobile(){
        document.getElementById("popup-3").classList.toggle("active");
    }

    function togglePopup_pwd(){
        document.getElementById("popup-4").classList.toggle("active");
    }

    function togglePopupupdate_remove(){
      document.getElementById("popup-5").classList.toggle("active");
    }

    

    function remove_disable(){
      var input = document.getElementsByClassName('moderator_radio');
      for (var i = 0; i < input.length; i++) {
                input[i].disabled = false;
            }
    }

    function remove_read_disable(){
      var input = document.getElementsByClassName('moderator_read_radio');
      for (var i = 0; i < input.length; i++) {
                input[i].disabled = false;
                
            }
    }


    function showPreview_2(event){
         if(event.target.files.length > 0){
             var src = URL.createObjectURL(event.target.files[0]);
             var preview = document.getElementById("file-ip-2-preview");
             preview.src = src;
             preview.style.display = "block";
             document.getElementById("popup-5").classList.add("popup_add_new_size");
             document.getElementById("popup-5-content").classList.add("content_add_new_size");
      
         }
    }



</script>

<?php
      if(isset($_POST['update_fname']) and isset($_POST['sysactor_new_first'])){
    
            $Moderator_ID = $_SESSION['System_Actor_ID'];
            $FirstName = $_POST['sysactor_new_first'];

            if($FirstName == NULL){
              echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
            }
            else {
                $FIRST = [
                  'Moderator_ID' => $Moderator_ID,
                  'FirstName' => $FirstName
                ];
                          
                $sql_1 = 'UPDATE system_actor
                    SET FirstName = :FirstName
                    WHERE System_Actor_Id = :Moderator_ID';
                          
                // prepare statement
                $statement_1 = $conn->prepare($sql_1);
                          
                // bind params
                $statement_1->bindParam(':Moderator_ID', $FIRST['Moderator_ID']);
                $statement_1->bindParam(':FirstName', $FIRST['FirstName']);
                          
                // execute the UPDATE statment
                if($statement_1->execute()){
                    echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
                }
              }
        }
        



     
      if(isset($_POST['update_lname']) and isset($_POST['sysactor_new_last'])){
    
            $Moderator_ID = $_SESSION['System_Actor_ID'];
            $LastName = $_POST['sysactor_new_last'];

            if($LastName == NULL){
              echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
            }
            else {
                $LAST = [
                  'Moderator_ID' => $Moderator_ID,
                  'LastName' => $LastName
                ];
                          
                $sql_1 = 'UPDATE system_actor
                    SET LastName = :LastName
                    WHERE System_Actor_Id = :Moderator_ID';
                          
                // prepare statement
                $statement_1 = $conn->prepare($sql_1);
                          
                // bind params
                $statement_1->bindParam(':Moderator_ID', $LAST['Moderator_ID']);
                $statement_1->bindParam(':LastName', $LAST['LastName']);
                          
                // execute the UPDATE statment
                if($statement_1->execute()){
                    echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
                }
              }
        }
        








     if(isset($_POST['update_mobile']) and isset($_POST['sysactor_new_mobile'])){
    
          $Moderator_ID = $_SESSION['System_Actor_ID'];
          $Mobile = $_POST['sysactor_new_mobile'];

          $regex = '/^(?:0|94|\+94)?(?:(?P<area>11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(?P<land_carrier>0|2|3|4|5|7|9)|7(?P<mobile_carrier>0|1|2|4|5|6|7|8)\d)\d{6}$/';  
   

          if(!preg_match_all($regex, $Mobile, $matches, PREG_SET_ORDER, 0)){
            echo '<script type="text/javascript">mobile_error();</script>';
          }
          else {
              $Mobile = [
                'Moderator_ID' => $Moderator_ID,
                'Mobile' => $Mobile
              ];
                        
              $sql_1 = 'UPDATE system_actor
                  SET Mobile = :Mobile
                  WHERE System_Actor_Id = :Moderator_ID';
                        
              // prepare statement
              $statement_1 = $conn->prepare($sql_1);
                        
              // bind params
              $statement_1->bindParam(':Moderator_ID', $Mobile['Moderator_ID']);
              $statement_1->bindParam(':Mobile', $Mobile['Mobile']);
                        
              // execute the UPDATE statment
              if($statement_1->execute()){
                  echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
              }
            }
        }



    if(isset($_POST['update_pwd']) and isset($_POST['sysactor_new_pwd_1']) and isset($_POST['sysactor_new_pwd_2'])){
    
          $Moderator_ID = $_SESSION['System_Actor_ID'];
          $pwd1 = $_POST['sysactor_new_pwd_1'];
          $pwd2 = $_POST['sysactor_new_pwd_2'];

          if($pwd1 == NULL or $pwd2 == NULL){
            echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
          }
          elseif($pwd1 != $pwd2){
            echo '<script type="text/javascript">pwd_not_match();</script>';
          }
          elseif(strlen($pwd1)<8){
            echo '<script type="text/javascript">pwd_length();</script>';
          }
          else {
              $PWD = [
                'Moderator_ID' => $Moderator_ID,
                'Password' => md5($pwd1)
              ];
                        
              $sql_1 = 'UPDATE login
                  SET Password = :Password
                  WHERE System_Actor_ID = :Moderator_ID';
                        
              // prepare statement
              $statement_1 = $conn->prepare($sql_1);
                        
              // bind params
              $statement_1->bindParam(':Moderator_ID', $PWD['Moderator_ID']);
              $statement_1->bindParam(':Password', $PWD['Password']);
                        
              // execute the UPDATE statment
              if($statement_1->execute()){
                  echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
              }

            }
        }



    if(isset($_POST['update_profile'])){
    
          $Moderator_ID = $_SESSION['System_Actor_ID'];

          $PROFILE = [
            'Moderator_ID' => $Moderator_ID,
            'Profile_Img' => file_get_contents($_FILES['update_upload']['tmp_name'])
            ];
                        
          $sql_1 = 'UPDATE system_actor
              SET Profile_Img = :Profile_Img
              WHERE System_Actor_ID = :Moderator_ID';
                        
          // prepare statement
          $statement_1 = $conn->prepare($sql_1);
                        
          // bind params
          $statement_1->bindParam(':Moderator_ID', $PROFILE['Moderator_ID']);
          $statement_1->bindParam(':Profile_Img', $PROFILE['Profile_Img']);
                        
          // execute the UPDATE statment
          if($statement_1->execute()){
              echo "<script> window.open('./Moderator_Profile.php','_self'); </script>";
          }

            
        }
        

?>



    
</body>
</html>