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
   <!-- <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">-->
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
  overflow-x:hidden;/* Hide scrollbars */
  }

  .inp1{
      width:12rem;
      margin-left:1.2rem;
      padding-left:5px;
  }

  .popup_login .popup_login_content {
    height:360px;
    width:300px;
  }

  .popup_signup .popup_signup_content{
    width:350px;
    height:390px;
  }

  .popup_signup2 .popup_signup_content2{
    width:350px;
    height:440px;
  }

  .txt{
    font-size:x-small;
      letter-spacing:1px;
  }

  .txt1{
    margin-left:1.25rem;
    color:#FF4444;
    cursor: pointer;
    font-weight:10;
  }

  .update_btn{
      border: none;
      width:5rem;
      margin-top:0.5rem;
      transition: 0.25s ease;
      box-shadow: none;
  }

  .update_btn:hover{
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.25);
    transform:scale(1.12);
  
  }

  .txt2{
    margin-left:1.25rem;
    font-weight:10;
    font-size:xx-small;
  }

  .txt3{
    font-weight:10;
    font-size:xx-small;
    color:blue;
    cursor: pointer;
  }

  .inpu2{
    margin-top:1rem;
    margin-left:-4rem;
  }

  .otp_btn{
    width:4rem;
    height:2rem;
    padding:0.1rem;
    font-size:13px;
    margin-left:1rem;
  }

  .otp_btn2{
    width:6rem;
    height:2rem;
    padding:0.1rem;
    font-size:13px;
    margin-left:4.5rem;
    margin-top:1rem;
  }

  .caption{
    text-align:center;
    font-size: 10.5px;
    margin-top:-0.5rem;
    color:#333; 
  }

  .finp{
    width:6.5rem;
  }

  .linp{
    width:7rem;
  }

  .einp{
    margin-top:0.6rem;
    width:15.5rem;
  }

  .next{
    float:right;
    margin-right:1.5rem;
    width:3rem;
    font-size:small;
    padding:0.5rem;
    font-weight:normal;
  }

  .prev{
      float: left;
      margin-left:1rem;
      width:3rem;
      font-size:small;
      font-weight:normal;
      padding:0.5rem;
  }

  .submit{
    float:right;
    margin-right:1.5rem;
  }

  .select_your_job{
    width: 16rem;
    padding: 0.4rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.ent{
  padding:2rem;
}

.pass{
  margin-top:0.8rem;
  margin-bottom:0.4rem;
}

.send{
  text-align:center;
  font-size:small;
  width:5rem;
}

#privacy{
  margin-left:1.3rem;
  font-size:5px;
}
.privacy_info{
  font-size:11px;
}

.sel{
  margin-bottom:10px;
}

.inp3{
  width:15.5rem;
}

.sel2{
  width:7.3rem;
}

.top_icon{
  float:right;
  margin-top:1.5rem;
  transform:scale(3);
  cursor: pointer;
  color:#eee;
  width:1rem;
  height:1rem;
  background: #5CD85A;
  padding:0.1rem;
  padding-bottom:0.3rem;
  transition:0.5s ease;
  margin-left:5rem;
  border-radius:5px;
  text-align:center;
}



.top_icon:hover{
  transform:scale(3.5); 
}



/*Form validation*/
          /* The message box is shown when the user clicks on the password field */
          .message {
            display:block;
            background: #f1f1f1;
            color: #000;
            width: 80%;
            position: relative;
            padding: 5px;
            margin-top: 10px;
            top:-4rem;
            left:9.7rem;
            border-radius: 10px;
          }

          .message::before{
              content: "";
              position: absolute;
              right: 100%;
              top: 20px;
              width: 0;
              height: 0;
              border-top: 13px solid transparent;
              border-right: 26px solid #f1f1f1;
              border-bottom: 13px solid transparent;
          }



          .message p {
            padding: 5px 5px;
            font-size: 12px;
          }


          .pass2{
            position: relative;
            top:-19.6rem;
            left:9rem;
            z-index: -1;
          }

          .comment_btn{
            position: relative;
            top:-19rem;
            z-index: -1;
          }

          .comment_btn_2{
            position: relative;
            top:-4rem;
          }


          #msg1{
            display:none;
            padding: 12px;
          }

          #msg2{
            display:none;
            left:18rem;
          }
          #msg2 p{
            font-size:14px;
          }

          #msg3{
            display:none;
            top:-3.5rem;
            left:18rem;
            width:8rem;
          }
          .rqs1{
            position: relative;
            top:-4.2rem;
          }

          #msg4{
            display:none;
            top:-3.5rem;
            left:18rem;
            width:8rem;
          }
          .rqs2{
            position: relative;
            top:-4.2rem;
          }

          #msg5{
            display:none;
            top:-3.5rem;
            left:18rem;
            width:8rem;
          }
          .rqs3{
            position: relative;
            top:-4.2rem;
          }

          #msg6{
            display:none;
            top:-3.5rem;
            left:15rem;
            width:8rem;
          }
          .rqs4{
            position: relative;
            top:-4.4rem;
          }

          #msg7{
            display:none;
            top:-3.5rem;
            left:15rem;
          }

          .rqs5{
            position: relative;
            top:-17rem;
          }

          #msg8{ 
            display:none;
            top:-3.5rem;
            left:15rem;
          }

          .rqs6{
            position: relative;
            top:-5rem;
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

/*Form validation End*/

.OTP_VERIFY_FORGOT{
  position: relative;
  top:-1.9rem;
  margin-left:5rem;
}

.otp_btn3{

  margin-left:2.8rem;
}

.Search_contact{
  height:2rem;
  cursor: pointer;
  margin-left:1rem;
}

.admin_details{
  height:250px;
  overflow-y:scroll;
}
.reporter_details{
  height:250px;
}

.moderator_details{
  height:250px;
}

.show_forget{
  display:none;
}

</style>

<body>

  <a name="start"></a>

  <div class="heder">
      
        <div class="left">
            <img src="../images/Name.svg" alt="" srcset="">
        </div>

        <div class="right">

                <ul>
                    <li> <a href="#start">Home</a> </li>
                    <li> <a href="#aboutus">About Us</a></li>
                    <li><a href="#contactus">Contact Us</a></li>
                </ul>
            
        </div>

  </div>
  
 
<!-- Moderator Page Content -->
<div class="content">

        <div class="content_left">
          <h1>NEWSLIA</h1>
              
              <div class="content_left_info">

                NEWSLIA, is the best news reporting system <br> which provides
                news and special <br> announcements that are related to <br> the user's area.
              </div>

              <div class="button_set">
                  <div class="button_login" onclick="togglePopup_login()">Login</div>
                  <div class="button_login" onclick="togglePopup_sign_up()">Sign Up</div>
              </div>

        </div>

        <div class="content_right">
            <img src="../images/background.svg" alt="" srcset="">
        </div>

</div>

<div class="about_us">
  <a name="aboutus"></a>
      <div class="para-box">
          <div class="head-para-type">
            <h1>About Us ...</h1>
          </div>

          <div>
              <p class="body-para">There is a great demand for people to know accurate and trustworthy news about their specific areas.The majority of that news is similar to gossip, which has a huge problem with accuracy as well as reliability.
                <br>
              Furthermore, there is no efficient way for them to receive information pertaining to their grama niladhari or Divisional Secretariat regions, such as vaccination programs, payments, and so forth.
              Furthermore, when people do not receive accurate news on time, they suffer a slew of problems.
              Some of the issues include wasting time and missing chances since they do not receive news/announcements at the appropriate moment.
              <br>

              Even though individuals are alerted, they might quickly forget about important occasions and activities since they do not receive any reminders.
              <br>

              So, with our system, users can able to get such information on time, as well as many other features such   as reminding about special events, reading / creating articles, and obtaining vital contact numbers. 
              </p>
          </div>       
      </div>

      <div class="top_icon" id="btnscrollToTop">
          <i class="fa fa-arrow-up"></i>
      </div>
</div>

<script>
 const btnscrollToTop = document.querySelector("#btnscrollToTop");
 btnscrollToTop.addEventListener("click",function(){
   window.scrollTo({
     top:0,
     left:0,
     behavior:"smooth"
   });
 });
</script>

<div class="about_us">
   <a name="contactus"></a>
    <div class="para-box">
        <div class="head-para-type2">
           <h1>Contact Us ...</h1>
        </div>
        
      <?php
        include '../Model/connect.php';
     ?>
        
        <div class="contact_info">     
              
              
              <div class="admin">
                <h3>Administrator</h3>
                <div class="admin_details">
                    <?php
                        $admin_details_sql = "SELECT * FROM system_actor WHERE Position = 'A'";
                      
                        $admin_details_statement = $conn -> query($admin_details_sql);
                        $admin_details_results = $admin_details_statement->fetchAll(PDO::FETCH_ASSOC);

                        if($admin_details_results){
                          foreach($admin_details_results as $admin_details_result){
                            echo "<p>".$admin_details_result['FirstName']." ".$admin_details_result['LastName']."</p>";

                            $ID= $admin_details_result['System_Actor_Id'];
                            
                            $admin_email_sql = "SELECT * FROM login WHERE System_Actor_ID = '$ID'";
                            $admin_email_statement = $conn -> query($admin_email_sql);
                            $admin_email_results = $admin_email_statement->fetchAll(PDO::FETCH_ASSOC);

                            if($admin_email_results){
                              foreach($admin_email_results as $admin_email_result){
                                  echo "<p class='email_contact'>".$admin_email_result['Email']."</p> ";
                                  
                              }
                            }
                          }
                        }
                    ?>
              </div>
    
        </div>
        </div>       
    </div>

    <div class="top_icon" id="btnscrollToTopsecond">
         <i class="fa fa-arrow-up"></i>
   </div>

   </div>
</div>

<script>
 const btnscrollToTop2 = document.querySelector("#btnscrollToTopsecond");
 btnscrollToTop2.addEventListener("click",function(){
   window.scrollTo({
     top:0,
     left:0,
     behavior:"smooth"
   });
 });
</script>



<?php
  $Date = date("Y-m-d");
  
  $sql_deactivate_list = "SELECT * FROM deactivate WHERE Date = '$Date'";
  $statement_deactivate_list = $conn->query($sql_deactivate_list);
  $results_deactivate_list = $statement_deactivate_list->fetchAll(PDO::FETCH_ASSOC);
  if($results_deactivate_list){
    foreach($results_deactivate_list as $value){
      $ID = $value['System_Actor_ID'];
      $sql = 'DELETE FROM system_actor WHERE System_Actor_Id = :System_Actor_Id';
      $statement = $conn->prepare($sql);
      $statement->bindParam(':System_Actor_Id', $ID); 
      if ($statement->execute()) {
        $sql_de = 'DELETE FROM deactivate WHERE System_Actor_ID = :System_Actor_ID';
        $statement_de = $conn->prepare($sql_de);
        $statement_de->bindParam(':System_Actor_ID', $ID); 
        $statement_de->execute();
      }
    }
  }


?>

<!--Popup windows -->

<div class="errorbox" id="error1">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Incorrect email address or password.</div>
       <div class="error_foot" onclick="remove_error_login()">OK</div>

  </div>
</div>

<div class="errorbox" id="error2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Please complete all required fields.</div>
       <div class="error_foot" onclick="remove_error_signup_1()">OK</div>

  </div>
</div>

<div class="errorbox" id="error3">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Invalid Email Address</div>
       <div class="error_foot" onclick="remove_error_signup_2_0()">OK</div>

  </div>
</div>


<div class="errorbox" id="error3_1">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Invalid Mobile Number</div>
       <div class="error_foot" onclick="remove_error_signup_2_1()">OK</div>

  </div>
</div>



<div class="errorbox" id="error3_2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Invalid NIC Number</div>
       <div class="error_foot" onclick="remove_error_signup_2_2()">OK</div>

  </div>
</div>


<div class="errorbox" id="error4">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Password must be at least 8 characters</div>
       <div class="error_foot" onclick="error_signup_3()">OK</div>

  </div>
</div>

<div class="errorbox" id="error5">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Confirm Password confirmation does not match.</div>
       <div class="error_foot" onclick="error_signup_4()">OK</div>

  </div>
</div>


<div class="errorbox" id="error6">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Sorry... Your email has already been taken.</div>
       <div class="error_foot" onclick="error_signup_5()">OK</div>

  </div>
</div>

<div class="errorbox" id="error7">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your mobile number has already been taken.</div>
       <div class="error_foot" onclick="error_signup_6()">OK</div>

  </div>
</div>

<div class="errorbox" id="error8">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your NIC number has already been taken.</div>
       <div class="error_foot" onclick="error_signup_7()">OK</div>

  </div>
</div>


<div class="errorbox" id="error9">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your Username has already been taken.</div>
       <div class="error_foot" onclick="error_signup_8()">OK</div>

  </div>
</div>

<div class="errorbox" id="error10">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body" style="color:#555;">Congratulations, your account has been successfully created.</div>
       <div class="error_foot" onclick="signup_msg1()" style="margin-top:-0.15rem;">OK</div>

  </div>
</div>


<div class="errorbox" id="error11">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body" style="color:#555;">Congratulations, Already have recorded your data,we will evaluate them and inform you later. </div>
       <div class="error_foot" onclick="signup_msg2()" style="margin-top:0.1rem;margin-right:1rem;">OK</div>

  </div>
</div>


<div class="errorbox" id="error12">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your NIC No is not in the System Database.</div>
       <div class="error_foot" onclick="forget_msg1()">OK</div>

  </div>
</div>


<div class="errorbox" id="error13">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your OTP Code is Incorrect.</div>
       <div class="error_foot" onclick="forget_msg2()">OK</div>

  </div>
</div>

<div class="errorbox" id="error14">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Your Password and Confirmation are not same.</div>
       <div class="error_foot" onclick="forget_msg3()">OK</div>

  </div>
</div>


<div class="popup popup_login" id="popup-7">

<div class="overlay"></div>

<div class="content popup_login_content">
    <div class="close-btn" onclick="togglePopup_login()">&times;</div>


    <div class="content_body popup_login_body">
        <div class="popup_logo">
             <img src="../images/Name.svg" alt="" srcset="">
        </div>
        <hr>

        <div class="popup_form">
            <h3 class="popup_title">Login</h3>
            <form action="./index.php" method="post" name="login_form">

 
               <input type="email" name="sysactoremail" placeholder="Email" id="username" class="inp inp1" required> <span style="color:red;font-size:13px;">*</span>
               <br>
               <br>
               <input type="password" name="sysactorpassword" id="password" class="inp inp1" placeholder="Password" required> <span style="color:red;font-size:13px;">*</span>
               <br>
               <span id="remember_me" class="txt txt1" onclick="togglePopup_forget()">Forgot Password?</span>

               <button type="submit" name ="login" class="update_btn" value="LOGIN">Login</button>

               <br>
               <br>
               <span id="remember_me" class="txt txt2">New to NEWSLIA?</span>
               <span id="remember_me" class="txt txt3" onclick="togglePopup_sign_up()">Create an Account</span>
        
             </form>
         </div>

    </div>
</div>

</div>


<div class="popup popup_forget" id="popup-8">

    <div class="overlay"></div>

    <div class="content popup_forget_content">
        <div class="close-btn" onclick="togglePopup_forget()">&times;</div>


        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Forgot Password</h3>
                
                <div>
                  
                  <form action="./index.php" method="post">
                      
                  
                      <input type="text" name="sysactorforgotNIC" placeholder="NIC No" id="forget_NIC" class="inp inp1">
                      <br>

                          <div class="message" id="msg6">
                            <p id="nic_check_forget" class="invalid">NIC number</p>
                          </div> 
          
                      <button class="update_btn otp_btn" id="otp_forget_btn" name="SEND_OPT_FORGET">Send</button>            
                      
                  </form>
                  
                  <form action="./index.php" method="post" class="OTP_VERIFY_FORGOT">
                        <p>Please Check your emails and gets the OTP code.</p>
                        <input type="text" name="sysactorotp" id="otp" class="inp inp1 inpu2" placeholder="OTP Code" maxlength="5" required>
                        <button name ="OTP_VERIFY" class="update_btn otp_btn2 otp_btn3" id="verify_forget_btn">Verify</button>
                  </form>

                  <br>
                  <br>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="popup popup_forget" id="popup-9">

    <div class="overlay"></div>

    <div class="content popup_forget_content">
        <div class="close-btn" onclick="togglePopup_reset_save()">&times;</div>


        <div class="content_body popup_forget_body">
            <div class="popup_logo">
                <img src="../images/Name.svg" alt="" srcset="">
            </div>
            <hr>

            <div class="popup_form">
                <h3 class="popup_title">Forgot Password</h3>
                <div name="login_form">
                
                 <form action="./index.php" method="post" name="login_form">

                        <input type="password" name="sysactor_new_psd_confirm" id="New-Forget-Password" class="inp inp1" placeholder="New Password" required>
                              
                              <div class="message" id="msg7">
                                  <h4>Password must contain the following:</h4>
                                  <p id="letter_2" class="invalid">A <b>lowercase</b> letter</p>
                                  <p id="capital_2" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                  <p id="number_2" class="invalid">A <b>number</b></p>
                                  <p id="length_2" class="invalid">Minimum <b>8 characters</b></p>
                              </div>

                        <br>
                        <br>
                        <input type="password" name="sysactor_new_re_psd_confirm" id="Re-New-Forget-Password" class="inp inp1" placeholder="Retype New Password" required>
                        <br>

                              <div class="message" id="msg8">
                                  <p id="confirmation_2" class="invalid">password confirmation match.</p>
                              </div> 
                            
                        <button class="update_btn otp_btn2" id="save_forget_rest" name = "SAVE_Forget_PWD">Save</button> 
                 </form>

                  <br>
                  <br> 
            </div>
            </div>

        </div>
    </div>

</div>



<script>
  
  function forget_msg1(){
      document.getElementById("error12").classList.toggle("active");
    }
  function forget_msg2(){
      document.getElementById("error13").classList.toggle("active");
    }

    function forget_msg3(){
      document.getElementById("error14").classList.toggle("active");
    }

    function forget_msg4(){

      document.getElementById("popup-8").classList.add("active");
      
      document.getElementById("forget_NIC").classList.add("show_forget");
      document.getElementById("otp_forget_btn").classList.add("show_forget");

      document.getElementById("otp").classList.remove("show_forget");
      document.getElementById("verify_forget_btn").classList.remove("show_forget");


    }
  function togglePopup_reset_password(){

    document.getElementById("popup-8").classList.remove("active");
    document.getElementById("popup-9").classList.add("active");
  }

  function signup_msg1(){
      document.getElementById("error10").classList.toggle("active");
  }

 function signup_msg2(){
      document.getElementById("error11").classList.toggle("active");
 }

</script>


<?php

      if(isset($_POST['SEND_OPT_FORGET'])){
          $FORGOT_NIC = $_POST['sysactorforgotNIC'];

          $nic_forgot_check_sql = "SELECT * FROM system_actor WHERE NIC = '$FORGOT_NIC'";
          $nic_forgot_check_statement = $conn -> query($nic_forgot_check_sql);
          $nic_forgot_check_results = $nic_forgot_check_statement->fetchAll(PDO::FETCH_ASSOC);

          if($nic_forgot_check_results){
            foreach($nic_forgot_check_results as $nic_forgot_check_result){
              
              $System_Actor_Id = $nic_forgot_check_result['System_Actor_Id'];

              $nic_forgot_email_sql = "SELECT * FROM login WHERE System_Actor_ID = '$System_Actor_Id'";
              $nic_forgot_email_statement = $conn -> query($nic_forgot_email_sql);
              $nic_forgot_email_results = $nic_forgot_email_statement->fetchAll(PDO::FETCH_ASSOC);

              if($nic_forgot_email_results){
                foreach($nic_forgot_email_results as $nic_forgot_email_result){

                  $System_Actor_Email = $nic_forgot_email_result['Email'];

                  include '../Control/login_Control.php';
                  $_SESSION['OTP_Code'] =  OTP_Code($System_Actor_Email);
                  echo "<script type='text/javascript'>forget_msg4();</script>";

                }
              }
            }
          }
          else{ 
            echo "<script type='text/javascript'>forget_msg1();</script>";
          }

      }


      if(isset($_POST['OTP_VERIFY'])){

  
        $OTP = $_POST['sysactorotp'];
        $SysOTP = $_SESSION['OTP_Code'];

        if($OTP == $SysOTP){
          echo "<script type='text/javascript'>togglePopup_reset_password();</script>";
        }
        else{
          echo "<script type='text/javascript'>forget_msg2()</script>";
        }

      }


      if(isset($_POST['SAVE_Forget_PWD'])){
        
        $pwd = $_POST['sysactor_new_psd_confirm'];
        $repwd = $_POST['sysactor_new_re_psd_confirm'];
        if($pwd == $repwd){
          include '../Control/login_Control.php';
          Pwd_Reset($pwd);
        }
        else{
          echo "<script type='text/javascript'>forget_msg3()</script>";
        }
        
      }

?>




<form action="./index.php" method = "POST">

          <div class="popup popup_signup" id="popup-10">

          <div class="overlay"></div>

          <div class="content popup_signup_content">
              <div class="close-btn" onclick="togglePopup_sign_up()">&times;</div>


              <div class="content_body popup_signup_body">
                  <div class="popup_logo">
                      <img src="../images/Name.svg" alt="" srcset="">
                  </div>
                  <hr>

                  <div class="popup_form">
                      <h3 class="popup_title">Sign Up</h3>
                      <p class="caption">Create your account.It's free and only takes a minute</p>
                      <div name="login_form">

                        <input type="text" name="sysactor_first_name" id="new_fname" class="inp inp1 finp" placeholder="First Name" required> <span style="color:red;font-size:13px;">*</span>
                        
                        <input type="text" name="sysactor_last_name" id="new_lname" class="inp inp1 linp" placeholder="Second Name" required style="margin-left:0.5rem;"> <span style="color:red;font-size:13px;">*</span>
                          
                        <input type="text" name="sysactor_email" id="new_email" class="inp inp1 einp" placeholder="Email Address" required> <span style="color:red;font-size:13px;">*</span>
                        
                            <div class="message" id="msg3">
                               <p id="email_check" class="invalid">email address</p>
                            </div> 

                        <input type="text" name="sysactor_mobile" id="new_mobile" class="inp inp1 einp" placeholder="Mobile Number" required> <span style="color:red;font-size:13px;" id="new_mobile_star">*</span>
                            
                            <div class="message" id="msg4">
                               <p id="mobile_check" class="invalid">mobile number</p>
                            </div> 
                            
                        <input type="text" name="sysactor_nic" id="new_nic" class="inp inp1 einp" placeholder="NIC Number" required> <span style="color:red;font-size:13px;" id="new_nic_star" class="">*</span>
                           
                            <div class="message" id="msg5">
                               <p id="nic_check" class="invalid">NIC number</p>
                            </div> 

                        <div class="update_btn next" id="new_next_1" onclick="togglePopup_sign_up_2()">Next</div>
                        <br>
                        <br> 
                  </div>
                  </div>

              </div>
          </div>

          </div>







          <div class="popup popup_signup2" id="popup-11">

          <div class="overlay"></div>

          <div class="content popup_signup_content2">
              <div class="close-btn" onclick="togglePopup_sign_up_2()">&times;</div>


              <div class="content_body popup_signup_body">
                  <div class="popup_logo">
                      <img src="../images/Name.svg" alt="" srcset="">
                  </div>
                  <hr>

                  <div class="popup_form">
                      <h3 class="popup_title">Sign Up</h3>
                      
                      <div name="login_form">

                      
          
                        <select name="job" id="" class="select_your_job inp1 sel" required> 
                          <option value="0" disabled selected hidden class="ent">Your Job</option>
                          <option value="normal_user" class="ent">Normal User</option>
                          <option value="reporter" class="ent">Reporter</option>
                          <option value="moderator" class="ent">Moderator</option>
                        </select> <span style="color:red;font-size:13px;">*</span>

                        
                        <br>
                        <select name="province" id="new_Province" class="select_your_job inp1 sel sel2" required>
                          <option value="" class="ent" disabled selected hidden>Province</option>

                          <?php
                               $query = "SELECT * FROM dsa GROUP BY Province";
                               $query_statement = $conn->query($query);
                               $query_results = $query_statement->fetchAll(PDO::FETCH_ASSOC);
                               
                               if($query_results){
                                 foreach($query_results as $query_result){
                                  echo "<option value=".$query_result['Province'].">".$query_result['Province']."</option>";
                                 }
                               }
                               else{
                                echo '<option value="">Provinces not available</option>';
                               }
                          ?>
                          
                        </select> <span style="color:red;font-size:13px;">*</span>

                        <select name="district" id="new_District" class="select_your_job inp1 sel sel2" style="margin-left:0.5rem;" required>
                          <option value="" class="ent">District</option>
                        </select> <span style="color:red;font-size:13px;">*</span>
                        
                        
                        <br>

                        <select name="dsa" id="new_DSA" class="select_your_job inp1 sel" required>
                          <option value="" class="ent">Divisional Secretariat Area </option>
                        </select>  <span style="color:red;font-size:13px;">*</span>


                        <input type="text" name="sysactor_new_username" id="new_uname" class="inp inp1 inp3" placeholder="Username" required> <span style="color:red; font-size:13px;">*</span>

                        <br>
                        <input type="password" name="sysactor_pwd" id="new_pwd" class="inp inp1 finp pass" placeholder="Password" maxlength="15" required> <span style="color:red;font-size:13px;">*</span>
                        
                        <div class="message" id="msg1">
                            <h4>Password must contain the following:</h4>
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>

                        
                        <input type="password" name="sysactor_rpwd" id="re_new_pwd" class="inp inp1 linp pass" placeholder="Retype Password" maxlength="15" style="margin-left:0.5rem;" required>
                        
                        <br>

                        
                        <div class="message" id="msg2">
                            <p id="confirmation" class="invalid">password confirmation match.</p>
                        </div> 
                        
                        <!--<input type="checkbox" id="privacy" name="privacy" value="1">
                        <label for="privacy" class="privacy_info"> I accept the Terms of Use & Privacy Policy.</label>-->
                        
                        <div class="update_btn prev" id="Pre_2_btn" onclick="togglePopup_sign_up_3()">Prev</div> 
                        <button class="update_btn submit send" id="submit_2_btn" name="signup">Submit</button>

                        <br>
                        <br> 
                  </div>
                  </div>

              </div>
          </div>

          </div>


</form>


<script type="text/javascript">

      /* Form Validation*/
            
            //Part 1
            
            var new_pwd = document.getElementById("new_pwd");
            var re_new_pwd = document.getElementById("re_new_pwd");

            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");
            var confirmation = document.getElementById("confirmation");


            /*Password required msg*/ 
            
            /*new_pwd.onfocus = function(){
              document.getElementById("msg1").style.display = "block";
              document.getElementById("re_new_pwd").classList.add("pass2");
              document.getElementById("Pre_2_btn").classList.add("comment_btn");
              document.getElementById("submit_2_btn").classList.add("comment_btn");
            }*/ 

            new_pwd.onblur = function(){
              document.getElementById("msg1").style.display = "none";
              document.getElementById("re_new_pwd").classList.remove("pass2");
              document.getElementById("Pre_2_btn").classList.remove("comment_btn");
              document.getElementById("submit_2_btn").classList.remove("comment_btn");
            } 

            /*Password Confirmation msg*/ 
            /*re_new_pwd.onfocus = function(){
              document.getElementById("msg2").style.display = "block";
              document.getElementById("Pre_2_btn").classList.add("comment_btn_2");
              document.getElementById("submit_2_btn").classList.add("comment_btn_2");
            }*/ 

            re_new_pwd.onblur = function(){
              document.getElementById("msg2").style.display = "none";
              document.getElementById("Pre_2_btn").classList.remove("comment_btn_2");
              document.getElementById("submit_2_btn").classList.remove("comment_btn_2");
            } 

            // When the user starts to type something inside the password field
            new_pwd.onkeyup = function() {

              document.getElementById("msg1").style.display = "block";
              document.getElementById("re_new_pwd").classList.add("pass2");
              document.getElementById("Pre_2_btn").classList.add("comment_btn");
              document.getElementById("submit_2_btn").classList.add("comment_btn");

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

            // When the user starts to type something inside the confirmation password field
            re_new_pwd.onkeyup = function(){

              document.getElementById("msg2").style.display = "block";
              document.getElementById("Pre_2_btn").classList.add("comment_btn_2");
              document.getElementById("submit_2_btn").classList.add("comment_btn_2");

              if(re_new_pwd.value == new_pwd.value) {  
                confirmation.classList.remove("invalid");
                confirmation.classList.add("valid");
              } else {
                confirmation.classList.remove("valid");
                confirmation.classList.add("invalid");
              }
            }


            //Part 2

            var new_email = document.getElementById("new_email");
            var new_mobile = document.getElementById("new_mobile");
            var new_nic = document.getElementById("new_nic");
            var email_check = document.getElementById("email_check");
            var mobile_check = document.getElementById("mobile_check");
            var nic_check = document.getElementById("nic_check");

            /*email required msg*/ 
            
            /*new_email.onfocus = function(){
              document.getElementById("msg3").style.display = "block";
              document.getElementById("new_mobile").classList.add("rqs1");
              document.getElementById("new_nic").classList.add("rqs1");
              document.getElementById("new_mobile_star").classList.add("rqs1");
              document.getElementById("new_nic_star").classList.add("rqs1");
              document.getElementById("new_next_1").classList.add("rqs1");
            }*/ 

            new_email.onblur = function(){
              document.getElementById("msg3").style.display = "none";
              document.getElementById("new_mobile").classList.remove("rqs1");
              document.getElementById("new_nic").classList.remove("rqs1");
              document.getElementById("new_mobile_star").classList.remove("rqs1");
              document.getElementById("new_nic_star").classList.remove("rqs1");
              document.getElementById("new_next_1").classList.remove("rqs1");
            } 


            // When the user starts to type something inside the email field
            new_email.onkeyup = function(){

                document.getElementById("msg3").style.display = "block";
                document.getElementById("new_mobile").classList.add("rqs1");
                document.getElementById("new_nic").classList.add("rqs1");
                document.getElementById("new_mobile_star").classList.add("rqs1");
                document.getElementById("new_nic_star").classList.add("rqs1");
                document.getElementById("new_next_1").classList.add("rqs1");
                
                const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;                  
                if(new_email.value.match(mailformat)) {  
                  email_check.classList.remove("invalid");
                  email_check.classList.add("valid");
                } else {
                  email_check.classList.remove("valid");
                  email_check.classList.add("invalid");
                }
            }


            /*mobile required msg*/ 
            /*new_mobile.onfocus = function(){
              document.getElementById("msg4").style.display = "block";
              document.getElementById("new_nic").classList.add("rqs2");
              document.getElementById("new_nic_star").classList.add("rqs2");
              document.getElementById("new_next_1").classList.add("rqs2");
            }*/ 

            new_mobile.onblur = function(){
              document.getElementById("msg4").style.display = "none";
              document.getElementById("new_nic").classList.remove("rqs2");
              document.getElementById("new_nic_star").classList.remove("rqs2");
              document.getElementById("new_next_1").classList.remove("rqs2");
            }
            
            // When the user starts to type something inside the mobile field
            new_mobile.onkeyup = function(){

                document.getElementById("msg4").style.display = "block";
                document.getElementById("new_nic").classList.add("rqs2");
                document.getElementById("new_nic_star").classList.add("rqs2");
                document.getElementById("new_next_1").classList.add("rqs2");
                
                const mobileformat = /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$/;                  
                if(mobileformat.exec(new_mobile.value)) {  
                  mobile_check.classList.remove("invalid");
                  mobile_check.classList.add("valid");
                } else {
                  mobile_check.classList.remove("valid");
                  mobile_check.classList.add("invalid");
                }
            }


            /*NIC required msg*/ 
            /*new_nic.onfocus = function(){
              document.getElementById("msg5").style.display = "block";
              document.getElementById("new_next_1").classList.add("rqs3");
            }*/ 

            new_nic.onblur = function(){
              document.getElementById("msg5").style.display = "none";
              document.getElementById("new_next_1").classList.remove("rqs3");
            } 

            // When the user starts to type something inside the NIC field
            new_nic.onkeyup = function(){
                document.getElementById("msg5").style.display = "block";
                document.getElementById("new_next_1").classList.add("rqs3");
                const nicformat = /^([0-9]{9}[v|V]|[0-9]{12})$/;
                if(nicformat.exec(new_nic.value)) {  
                  nic_check.classList.remove("invalid");
                  nic_check.classList.add("valid");
                } else {
                  nic_check.classList.remove("valid");
                  nic_check.classList.add("invalid");
                }
            }

            //Part 3

            var forget_NIC = document.getElementById("forget_NIC");
            var nic_check_forget = document.getElementById("nic_check_forget");
            
            /*email required msg*/ 
            /*forget_NIC.onfocus = function(){
              document.getElementById("msg6").style.display = "block";
              document.getElementById("otp").classList.add("rqs4");
              document.getElementById("otp_forget_btn").classList.add("rqs4");
              document.getElementById("verify_forget_btn").classList.add("rqs4");
            }*/ 

            forget_NIC.onblur = function(){
              document.getElementById("msg6").style.display = "none";
              document.getElementById("otp").classList.remove("rqs4");
              document.getElementById("otp_forget_btn").classList.remove("rqs4");
              document.getElementById("verify_forget_btn").classList.remove("rqs4");
            } 

            // When the user starts to type something inside the NIC field forget
            forget_NIC.onkeyup = function(){

                document.getElementById("msg6").style.display = "block";
                document.getElementById("otp").classList.add("rqs4");
                document.getElementById("otp_forget_btn").classList.add("rqs4");
                document.getElementById("verify_forget_btn").classList.add("rqs4");
                
                const nicformat = /^([0-9]{9}[v|V]|[0-9]{12})$/;
                if(nicformat.exec(forget_NIC.value)) {  
                  nic_check_forget.classList.remove("invalid");
                  nic_check_forget.classList.add("valid");
                } else {
                  nic_check_forget.classList.remove("valid");
                  nic_check_forget.classList.add("invalid");
                }
            }
            


            //Part 3

            var New_Forget_Password = document.getElementById("New-Forget-Password");
            var Re_New_Forget_Password = document.getElementById("Re-New-Forget-Password");


            var letter2 = document.getElementById("letter_2");
            var capital2 = document.getElementById("capital_2");
            var number2 = document.getElementById("number_2");
            var length2 = document.getElementById("length_2");
            var confirmation2 = document.getElementById("confirmation_2");
            
            /*pwd required msg*/ 
            /*New_Forget_Password.onfocus = function(){
              document.getElementById("msg7").style.display = "block";
              document.getElementById("Re-New-Forget-Password").classList.add("rqs5");
              document.getElementById("save_forget_rest").classList.add("rqs5");
            }*/ 

            New_Forget_Password.onblur = function(){
              document.getElementById("msg7").style.display = "none";
              document.getElementById("Re-New-Forget-Password").classList.remove("rqs5");
              document.getElementById("save_forget_rest").classList.remove("rqs5");
            } 

            // When the user starts to type something inside the forget password reset password
            New_Forget_Password.onkeyup = function() {
              
              document.getElementById("msg7").style.display = "block";
              document.getElementById("Re-New-Forget-Password").classList.add("rqs5");
              document.getElementById("save_forget_rest").classList.add("rqs5");

              var lowerCaseLetters = /[a-z]/g;
              if(New_Forget_Password.value.match(lowerCaseLetters)) {  
                letter2.classList.remove("invalid");
                letter2.classList.add("valid");
              } else {
                letter2.classList.remove("valid");
                lette2.classList.add("invalid");
              }
              
              // Validate capital letters
              var upperCaseLetters = /[A-Z]/g;
              if(New_Forget_Password.value.match(upperCaseLetters)) {  
                capital2.classList.remove("invalid");
                capital2.classList.add("valid");
              } else {
                capital2.classList.remove("valid");
                capital2.classList.add("invalid");
              }

              // Validate numbers
              var numbers = /[0-9]/g;
              if(New_Forget_Password.value.match(numbers)) {  
                number2.classList.remove("invalid");
                number2.classList.add("valid");
              } else {
                number2.classList.remove("valid");
                number2.classList.add("invalid");
              }
              
              // Validate length
              if(New_Forget_Password.value.length >= 8) {
                length2.classList.remove("invalid");
                length2.classList.add("valid");
              } else {
                length2.classList.remove("valid");
                length2.classList.add("invalid");
              }
            }


        /*re pwd required msg*/ 
        /*Re_New_Forget_Password.onfocus = function(){
            document.getElementById("msg8").style.display = "block";
            document.getElementById("save_forget_rest").classList.add("rqs6");
          }*/ 

          Re_New_Forget_Password.onblur = function(){
            document.getElementById("msg8").style.display = "none";
            document.getElementById("save_forget_rest").classList.remove("rqs6");
          } 

        // When the user starts to type something inside the confirmation password field in forget password reset
        Re_New_Forget_Password.onkeyup = function(){
            document.getElementById("msg8").style.display = "block";
            document.getElementById("save_forget_rest").classList.add("rqs6");
            if(Re_New_Forget_Password.value == New_Forget_Password.value) {  
              confirmation.classList.remove("invalid");
              confirmation.classList.add("valid");
            } else {
              confirmation.classList.remove("valid");
              confirmation.classList.add("invalid");
            }
         }

      
      /* Form Validation End*/

      

      $(document).ready(function(){
        $("#Province").on("change",function(){
          var Province = $(this).val();
          $.ajax({
            url :"../Control/action.php",
            type:"POST",
            cache:false,
            data:{Province:Province},
            success:function(data){
            $("#District").html(data);
            $('#DSA').html('<option value="">Divisional Secretariat Area</option>');
          }
          });
        });


      $("#District").on("change",function(){
        var District = $(this).val();
        $.ajax({
            url :"../Control/action.php",
            type:"POST",
            cache:false,
            data:{District:District},
            success:function(data){
            $("#DSA").html(data);
          }
        });
      }); 
    });




    $(document).ready(function(){
        $("#new_Province").on("change",function(){
          var Province = $(this).val();
          $.ajax({
            url :"../Control/action.php",
            type:"POST",
            cache:false,
            data:{Province:Province},
            success:function(data){
            $("#new_District").html(data);
            $('#new_DSA').html('<option value="">Divisional Secretariat Area</option>');
          }
          });
        });


      $("#new_District").on("change",function(){
        var District = $(this).val();
        $.ajax({
            url :"../Control/action.php",
            type:"POST",
            cache:false,
            data:{District:District},
            success:function(data){
            $("#new_DSA").html(data);
          }
        });
      }); 
    });


    

</script>



<script type="text/javascript">
    function togglePopup_login(){
      document.getElementById("popup-7").classList.toggle("active");
    }

    function togglePopup_forget(){
      document.getElementById("popup-7").classList.toggle("active");
      document.getElementById("popup-8").classList.toggle("active");

      document.getElementById("forget_NIC").classList.remove("show_forget");
      document.getElementById("otp_forget_btn").classList.remove("show_forget");

      document.getElementById("otp").classList.add("show_forget");
      document.getElementById("verify_forget_btn").classList.add("show_forget");


    }
    function togglePopup_forget_email(){
      document.getElementById("popup-8").classList.add("active");
    }
   
    function togglePopup_reset_password(){
      document.getElementById("popup-8").classList.toggle("active");
      document.getElementById("popup-9").classList.toggle("active");
    }

    function togglePopup_reset_save(){
      document.getElementById("popup-9").classList.toggle("active");
      document.getElementById("popup-7").classList.toggle("active");
    }
  
  
    function togglePopup_sign_up(){
      document.getElementById("popup-7").classList.remove("active");
      document.getElementById("popup-10").classList.toggle("active");
    }

    function togglePopup_sign_up_2(){
      document.getElementById("popup-10").classList.remove("active");
      document.getElementById("popup-11").classList.toggle("active");
    }

    function togglePopup_sign_up_3(){
      document.getElementById("popup-11").classList.remove("active");
      document.getElementById("popup-10").classList.toggle("active");
    }

    function error_login(){
      document.getElementById("error1").classList.add("active");
    }

    function remove_error_login(){
      document.getElementById("error1").classList.remove("active");
    }
    

    function error_signup_1(){
      document.getElementById("error2").classList.add("active");
    }

    function remove_error_signup_1(){
      document.getElementById("error2").classList.remove("active");
    }

    function error_signup_2(){
      document.getElementById("error3").classList.add("active");
    }

    function remove_error_signup_2(){
      document.getElementById("error3").classList.remove("active");
    }




    function remove_error_signup_2_0(){
      document.getElementById("error3").classList.toggle("active");
    }

    function remove_error_signup_2_1(){
      document.getElementById("error3_1").classList.toggle("active");
    }


    function remove_error_signup_2_2(){
      document.getElementById("error3_2").classList.toggle("active");
    }




    function error_signup_3(){
      document.getElementById("error4").classList.toggle("active");
    }

    function error_signup_4(){
      document.getElementById("error5").classList.toggle("active");
    }

    function error_signup_5(){
      document.getElementById("error6").classList.toggle("active");
    }

    function error_signup_6(){
      document.getElementById("error7").classList.toggle("active");
    }

    function error_signup_7(){
      document.getElementById("error8").classList.toggle("active");
    }

    function error_signup_8(){
      document.getElementById("error9").classList.toggle("active");
    }


</script>

<?php
  if(isset($_POST['login'])){
    $email = $_POST['sysactoremail'];
    $pwd = $_POST['sysactorpassword'];

    if(filter_var($email,FILTER_VALIDATE_EMAIL) and (strlen($pwd)<=15 and strlen($pwd)>=8)){
       // echo '<script type="text/javascript">remove_error_login();</script>';
        include '../Control/login_Control.php';
        $connect =  login($email,$pwd);
        if($connect == 'false'){
          echo '<script type="text/javascript">error_login();</script>';
        }
        elseif($connect == 'M'){
          $_SESSION['Actor_Type'] = "MODERATOR";
          echo '<script type="text/javascript">window.open("./Moderator_Home.php", "_self");</script>'; 
        }
        elseif($connect == 'N'){
          $_SESSION['Actor_Type'] = "NORMALUSER";
          echo '<script type="text/javascript">window.open("./N_User_Home.php", "_self");</script>';
        }
        elseif($connect == 'R'){
          $_SESSION['Actor_Type'] = "REPORTER";
          echo '<script type="text/javascript">window.open("./Reporter-After-loged-Home.php", "_self");</script>';
        }   

        elseif($connect == 'A'){
          $_SESSION['Actor_Type'] = "ADMIN";
          echo '<script type="text/javascript">window.open("./Admin_home.php", "_self");</script>';
        } 

    }
    else{
        echo '<script type="text/javascript">error_login();</script>';
    }

  }


  if(isset($_POST['signup'])){

        $first = $_POST['sysactor_first_name'];
        $last = $_POST['sysactor_last_name'];
        
        $email = $_POST['sysactor_email'];
        $mobile = $_POST['sysactor_mobile'];
        $nic = $_POST['sysactor_nic'];
        
        $job = $_POST['job'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $dsa = $_POST['dsa'];

        $username_new = $_POST['sysactor_new_username'];

        $pwd = $_POST['sysactor_pwd'];
        $repwd = $_POST['sysactor_rpwd'];

        //$privacy = $_POST['privacy'];

        //echo '<script>alert("'.$username_new.'")</script>'; 


        $regex = '/^(?:0|94|\+94)?(?:(?P<area>11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(?P<land_carrier>0|2|3|4|5|7|9)|7(?P<mobile_carrier>0|1|2|4|5|6|7|8)\d)\d{6}$/';  
   

        if (empty($first) || empty($last) || empty($email) || empty($mobile) || empty($nic) || empty($job) || empty($province) 
        || empty($district) || empty($dsa) || empty($username_new) || empty($pwd) || empty($repwd))
        {
          echo '<script type="text/javascript">error_signup_1();</script>';
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          echo '<script type="text/javascript">remove_error_signup_2_0();</script>';
        }
        elseif(!preg_match_all($regex, $mobile, $matches, PREG_SET_ORDER, 0)){
          echo '<script type="text/javascript">remove_error_signup_2_1();</script>';
        }
        elseif(!preg_match('/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $nic)){
          echo '<script type="text/javascript">remove_error_signup_2_2();</script>';
        }
        else{
          if(strlen($pwd)<8){
              echo '<script type="text/javascript">error_signup_3();</script>';
          }
          elseif($pwd != $repwd){
            echo '<script type="text/javascript">error_signup_4();</script>';
          }
          else{
            include '../Model/connect.php';
            
            //Email
            $email_check_sql = "SELECT * FROM login WHERE Email = '$email'";
            $email_check_statement = $conn -> query($email_check_sql);
            $email_check_results = $email_check_statement->fetchAll(PDO::FETCH_ASSOC);

            //Mobile
            $mobile_check_sql = "SELECT * FROM system_actor WHERE Mobile = '$mobile'";
            $mobile_check_statement = $conn -> query($mobile_check_sql);
            $mobile_check_results = $mobile_check_statement->fetchAll(PDO::FETCH_ASSOC);


            //NIC
            $nic_check_sql = "SELECT * FROM system_actor WHERE NIC = '$nic'";
            $nic_check_statement = $conn -> query($nic_check_sql);
            $nic_check_results = $nic_check_statement->fetchAll(PDO::FETCH_ASSOC);


            //Username
            $username_check_sql = "SELECT * FROM system_actor WHERE UserName = '$username_new'";
            $username_check_statement = $conn -> query($username_check_sql);
            $username_check_results = $username_check_statement->fetchAll(PDO::FETCH_ASSOC);


            if($email_check_results){
              echo '<script type="text/javascript">error_signup_5();</script>';  
            }
            elseif($mobile_check_results){
              echo '<script type="text/javascript">error_signup_6();</script>';  
            }
            elseif($nic_check_results){
              echo '<script type="text/javascript">error_signup_7();</script>';  
            }

            elseif($username_check_results){
              echo '<script type="text/javascript">error_signup_8();</script>';  
            }

            else{
              include '../Control/login_Control.php';

              

              $signup_connection =  signup($first,$last,$email,$mobile,$nic,$job,$dsa,$username_new,$pwd);
              if ($signup_connection == "User"){
                echo "<script type='text/javascript'>signup_msg1();</script>";
              }
              elseif ($signup_connection == "Staff"){
                echo "<script type='text/javascript'>signup_msg2();</script>";
              }
              

            }


          }

        }
        


        

  }
  
?>

    
</body>
</html>