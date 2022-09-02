<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NEWSLIA</title>
  <link rel="stylesheet" href="../css/nav/final-navigation.css">
  <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
  <link rel="stylesheet" href="../css/nav/Mobile.css">
  <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>


<style>
  body {
    overflow-x: hidden;
  }

  .navigation-profile-menu-container {
    margin-right: 160px;
  }

  .navigation-down {
    margin-left: 5px;
  }

  .fa-customize {
    font-size: 22px;
    color: black;
  }

  .fa-check:before {
    content: "\f00c";
    color: lightgreen;
  }


  .navigation-notification{
    margin-bottom:0.5rem;
    padding: 1rem;
    color:#444;
    font-weight:10px;
    letter-spacing:1px;
    transition: 0.5s ease;
    width: 95%; 
    display: flex; 
    justify-content: space-between; 
    background-color: #ECECEC;
  }

  .navigation-notification:hover{
    transform:scale(1.1);
  }



  .deactivate-1-main-container {
    margin: auto;
    margin-top: 100px;
    width: 328px;
    height: 270px;
    border: black 1px solid;
  }
  
  .deactivate-1-up {
    width: 100%;
    height: 25%;
    display: flex;
    border-bottom: 1px solid black;
  }
  
  .deactivate-1-down {
    width: 100%;
    height: 75%;
  }
  
  .deactivate-1-up-left {
    height: 100%;
    width: 90%;
    text-align: center;
  }
  
  .deactivate-1-up-left img {
    margin-top: 5%;
    width: 90%;
    height: 73%;
  }
  
  .deactivate-1-up-right {
    height: 100%;
    width: 10%;
  
    text-align: center;
  }
  
  .deactivate-1-deactivation-form-header {
    color: #8b7c7c;
    text-decoration: underline;
    margin-left: 10px;
    margin-top: 7px;
  }
  
  .deactivate-1-paragraph {
    text-align: center;
    margin: 18px;
    margin-top: 12px;
    margin-bottom: 25px;
    font-size:15px;
  }
  
  .deactivate-1-button {
    margin-top: 20px;
  }


  .deactivate-2-main-container {
    margin: auto;
    margin-top: 100px;
    width: 328px;
    height: 270px;
    border: black 1px solid;
  }
  
  .deactivate-2-up {
    width: 100%;
    height: 30%;
    display: flex;
    border-bottom: 1px solid black;
  }
  
  .deactivate-2-down {
    width: 100%;
    height: 70%;
  }
  
  .deactivate-2-up-left {
    height: 100%;
    width: 90%;
    text-align: center;
  }
  
  .deactivate-2-up-left img {
    margin-top: 5%;
    width: 90%;
    height: 73%;
  }
  
  .deactivate-2-up-right {
    height: 100%;
    width: 10%;
    text-align: center;
  }
  
  .deactivate-2-deactivation-form-header {
    color: #8b7c7c;
    text-decoration: underline;
    margin-left: 11px;
    margin-top: 7px;
  }
  
  .deactivate-2-deactivation-form {
    text-align: center;
    margin-top: 20px;
  }
  
  input:focus::placeholder {
    color: transparent;
  }
  
  .deactivate-2-input-1 {
    width: 80%;
    padding-left: 5px;
    background: #ebeaea;
    height: 36px;
    border: none;
    margin: 5px;
    outline: none;
    margin-top:-3rem;

  }
  
  .deactivate-2-button {
    margin-top: 20px;
  }


</style>


<body>
<div class="navigation-heder">

<div class="navigation-left">
    <img src="../images/logo.svg" alt="" srcset="">
</div>

<div class="navigation-center">
    <img src="../images/Name.svg" alt="" srcset="">
</div>

<div class="navigation-right">

    <p>
        <?php

           include '../Model/connect.php';
           $ID = $_SESSION['System_Actor_ID'];

           $profile_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$ID')"; 
           $profile_statement = $conn -> query($profile_sql);
           $profile_results = $profile_statement->fetchAll(PDO::FETCH_ASSOC);      
          
           if($profile_results){
            foreach($profile_results as $profile_result){
             
              $img = $profile_result['Profile_Img'];
              $img = base64_encode($img);
              $text = pathinfo($profile_result['System_Actor_Id'], PATHINFO_EXTENSION);

              }
            }
          
          /*if($img != NULL){
              echo "<img src='data:image/".$text.";base64,".$img."'/ class='down' style='transform:scale(0.35);margin-top:-2rem;border-radius:10%;margin-bottom:-2rem;width:100px;'>";
          }
          else{*/
              echo "<img src='../images/Profile.svg' class='down' style='margin-bottom:1rem; margin-top:1rem;'>";
         // }

        ?>

        <p style="margin-top:-0.5rem; margin-bottom:0.5rem;">
          <a href="Moderator_Profile.php" style="text-decoration:none;"><?php echo $_SESSION['FName']." ".$_SESSION['LName']; ?> </a>
        </p>
       

    </p>
           
  <div class="navigation-profile-menu-container" style="margin-left:5rem;">
    <ul class="navigation-profile_menu">
              <li><a href="Moderator_Profile.php"> <img src="../images/other/profile.png" alt="" srcset=""> My Profile</a></li>
            
              <?php
                if($_SESSION['Actor_Type'] != "ADMIN"){
                  echo "<li><a href='Moderate_Area.php'><img src='../images/other/location.png'>Select Area</a></li>";
                }
              ?>
              
              <li><a href="Moderate_Post_Type.php"><img src="../images/other/type.png" alt="" srcset="">Select Type</a></li>
              
              <?php
                if($_SESSION['Actor_Type'] != "NORMALUSER" AND $_SESSION['Actor_Type'] != "ADMIN"){
                echo "<li><a href='Moderator_Insight.php'><img src='../images/other/insights.png'>Insights</a></li>";
                }
              ?>
              
              <li onclick="togglePopup_select_option('deactivate-1')"><a href="#"><img src="../images/other/deactivate.png" alt="" srcset="">Deactivate</a></li>
              <li><a href="logout.php"><img src="../images/other/logout.png" alt="" srcset="">Log Out</a></li>
    </ul>
  </div>

</div>



</div>


<?php

    if($_SESSION['Actor_Type'] == "MODERATOR"){

      echo "<ul class='navigation-menu'>



          <!-- Home -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Moderator_Home.php' class='navigation-dropbtn'>Home</a>
          </li>


          <!-- View -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_View_News.php' class='navigation-dropbtn'>View</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_View_News.php'>News</a>
              <a href='Moderator_View_Articles.php'>Articles</a>
              <a href='Moderator_View_Notices.php'>Notices</a>
              <a href='Moderator_View_Jobs.php'>Job Vacancies</a>
              <a href='Moderator_View_Ads.php'>Commercial Ads</a>
            </div>
          </li>


          <!-- Publish -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_Pending.php' class='navigation-dropbtn'>Publish</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_Pending.php'>Pending</a>
              <a href='Moderator_Set_Time.php'>Set Time</a>
            </div>
          </li>

          <!-- Important Contact -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_Important_View.php' class='navigation-dropbtn'>Important Contacts</a>
            <div class='navigation-view-content navigation-dropdown-content'>
                <a href='Moderator_Important_View.php'>View Contact Numbers</a>
                <a href='Moderator_Manage_ICN.php'>Edit Contact Numbers</a>
            </div>
          </li>


          <!-- Insights -->
          <li class='navigation-imporatnt navigation-dropdown'>
            <a href='Moderator_Reporter.php' class='navigation-dropbtn'>Insights</a>
          </li>


          <!-- More -->
          <li class='navigation-more navigation-dropdown' style='margin-top: 0;'>
            <a href='#' class='navigation-dropbtn'>More</a>

            <div class='navigation-more-content navigation-dropdown-content'>
              <a href='Moderator_save.php'>Saved</a>
              <a href='Moderator_Hidden.php'>Hidden</a>
              <a href='Moderator_Reminder.php'>Reminders</a>
              <a href='Report.php'>Reports</a>
            </div>

          </li>

          <li class='bell_icon' style='visibility: hidden;'><a href='#'><i class='fas fa-bell fa-customize'></i></a></li>
          <li class='menu_icon'><a href='#'><i class='fas fa-thin fa-bars' style='color:black;'></i></a></li>

      </ul>";
    
    }


    if($_SESSION['Actor_Type'] == "NORMALUSER"){

      echo "<ul class='navigation-menu'>



          <!-- Home -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='N_User_Home.php' class='navigation-dropbtn'>Home</a>
          </li>


          <!-- News -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Moderator_View_News.php' class='navigation-dropbtn'>News</a>
          </li>


          <!-- Articles -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_View_Articles.php' class='navigation-dropbtn'>Articles</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_View_Articles.php'>Articles</a>
              <a href='N_User_Write_Article.php'>Create Articles</a>
            </div>
          </li>

          <!-- Ads -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_View_Notices.php' class='navigation-dropbtn'>Advertisements</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_View_Notices.php'>Notices</a>
              <a href='Moderator_View_Jobs.php'>Job Vacancies</a>
              <a href='Moderator_View_Ads.php'>Commercial Ads</a>
              <a href='#' onclick=togglePopup_select_option('popup-type');>Create New</a>
            </div>
          </li>



          <!-- Important Nuumber -->
          <li class='navigation-imporatnt navigation-dropdown'>
            <a href='Moderator_Important_View.php' class='navigation-dropbtn'>Important Contacts</a>
          </li>


          <li class='navigation-more navigation-dropdown' style='margin-top: 0;'>
            <a href='#' class='navigation-dropbtn'>More</a>

            <div class='navigation-more-content navigation-dropdown-content'>
            <a href='N_User_Pending_Posts.php'>Pending</a>
            <a href='Moderator_save.php'>Saved</a>
            <a href='Moderator_Hidden.php'>Hidden</a>
            <a href='Moderator_Reminder.php'>Reminders</a>
            <a href='N_User_Drafted_Post.php'>Drafted</a>
            <a href='Report.php'>Reports</a>
            <a href='N_User_Completed_Post.php'>My Posts</a>
            </div>

          </li>

          <li class='bell_icon'><a href='#' onclick=togglePopup_select_option('notification');><i class='fas fa-bell fa-customize'></i></a></li>
          <li class='menu_icon'><a href='#'><i class='fas fa-thin fa-bars' style='color:black;'></i></a></li>
         
      </ul>";
    
    }



    if($_SESSION['Actor_Type'] == "REPORTER"){

      echo "<ul class='navigation-menu'>



          <!-- Home -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Reporter-After-loged-Home.php' class='navigation-dropbtn'>Home</a>
          </li>


          <!-- View -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_View_News.php' class='navigation-dropbtn'>View</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_View_News.php'>News</a>
              <a href='Moderator_View_Articles.php'>Articles</a>
              <a href='Moderator_View_Notices.php'>Notices</a>
              <a href='Moderator_View_Jobs.php'>Job Vacancies</a>
              <a href='Moderator_View_Ads.php'>Commercial Ads</a>
            </div>
          </li>



          <!-- Create -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='#' class='navigation-dropbtn'>Create</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Repoter_Wrie_News.php'>Create News</a>
              <a href='#' onclick=togglePopup_select_option('popup-type');>Create Ads</a>
            </div>
          </li>



          <!-- My Drafts -->
          <li class='navigation-imporatnt navigation-dropdown'>
            <a href='Repoter_Drafted_Post.php' class='navigation-dropbtn'>My Drafts</a>
          </li>



          <!-- My Work -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='#' class='navigation-dropbtn'>My Work</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Repoter_Pending_Post.php'>Pending</a>
              <a href='N_User_Completed_Post.php'>My Posts</a>
            </div>
          </li>


          <!-- More -->
          <li class='navigation-more navigation-dropdown' style='margin-top: 0;'>
            <a href='#' class='navigation-dropbtn'>More</a>

            <div class='navigation-more-content navigation-dropdown-content'>
            <a href='Moderator_save.php'>Saved</a>
            <a href='Moderator_Hidden.php'>Hidden</a>
            <a href='Moderator_Reminder.php'>Reminders</a>
            <a href='Report.php'>Reports</a>
            </div>

          </li>

          <li class='bell_icon'><a href='#' onclick=togglePopup_select_option('notification');><i class='fas fa-bell fa-customize'></i></a></li>
          <li class='menu_icon'><a href='#'><i class='fas fa-thin fa-bars' style='color:black;'></i></a></li>

      </ul>";
    
    }


    if($_SESSION['Actor_Type'] == "ADMIN"){

      echo "<ul class='navigation-menu'>



          <!-- Home -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Admin_home.php' class='navigation-dropbtn'>Home</a>
          </li>


          <!-- View -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_View_News.php' class='navigation-dropbtn'>View</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_View_News.php'>News</a>
              <a href='Moderator_View_Articles.php'>Articles</a>
              <a href='Moderator_View_Notices.php'>Notices</a>
              <a href='Moderator_View_Jobs.php'>Job Vacancies</a>
              <a href='Moderator_View_Ads.php'>Commercial Ads</a>
              <a href='Moderator_Important_View.php' class='navigation-dropbtn'>Important Contacts</a>
            </div>
          </li>

          



          <!-- Insights -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Moderator_Reporter.php' class='navigation-dropbtn'>Insights</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Moderator_Reporter.php'>Reporter</a>
              <a href='Moderator_List.php'>Moderator</a>
            </div>
          </li>


          <!-- Complain -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Complaints.php' class='navigation-dropbtn'>Complaints</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Complaints.php'>Complaints</a>
              <a href='Accepted Complaints.php'>Accepted Complaints</a>
              <a href='Rejected Complaints.php'>Rejected Complaints</a>
            </div>
          </li>


          <!-- Blacklist -->
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Blacklist.php' class='navigation-dropbtn'>Black List</a>
          </li>


          <!-- User Management -->
          <li class='navigation-view  navigation-dropdown'>
            <a href='Normal User Details.php' class='navigation-dropbtn'>User Management</a>
            <div class='navigation-view-content navigation-dropdown-content'>
              <a href='Normal User Details.php'>Normal User</a>
              <a href='Reporter Details.php'>Reporter</a>
              <a href='Moderator Details.php'>Moderator</a>
            </div>
          </li>

          <!-- Staff Registration -->
          
          <li class='navigation-imporatnt  navigation-dropdown'>
            <a href='Staff_Registration_Moderator.php' class='navigation-dropbtn'>Staff Registration</a>
          </li>


          <!-- More -->
          
          <li class='navigation-more navigation-dropdown' style='margin-top: 0;'>
            <a href='#' class='navigation-dropbtn'>More</a>

            <div class='navigation-more-content navigation-dropdown-content'>
            
            <a href='Moderator_save.php'>Saved</a>
            <a href='Moderator_Hidden.php'>Hidden</a>
            <a href='Moderator_Reminder.php'>Reminders</a>
            <a href='Report.php'>Reports</a>
      
            </div>

          </li>

          <li class='bell_icon' style='visibility: hidden;'><a href='#' onclick=togglePopup_select_option('notification');><i class='fas fa-bell fa-customize'></i></a></li>
          <li class='menu_icon'><a href='#'><i class='fas fa-thin fa-bars' style='color:black;'></i></a></li>
         
      </ul>";
    
    }

   

?>










  <!-- deactivate  popup - 1-->

  <div class="navigation-popup navigation-popup_set_time" id="deactivate-1">

    <div class="navigation-overlay"></div>

    <div class="navigation-content navigation-popup_set_time" style="width: 300px; height: 360px;">
      <div class="navigation-close-btn" onclick="togglePopup_select_option('deactivate-1')">&times;</div>


      <div class="navigation-content_body  navigation-popup_set_time_body">
        <div class="navigation-popup_logo">
        <img src="../images/Name.svg" alt="" srcset="">
        </div>
        <hr>

        <div class="deactivate-1-down">
          <h3 class="deactivate-1-deactivation-form-header">Delete your account permanently.</h3>

          <div class="deactivate-1-paragraph">
            <p>
              Your account will be deleted permanently <br>
              after 15 days. <br>
              Until date, you can active the account by <br>
              login to the account.
            </p>

            <div class="deactivate-1-button">
              <a href="#" onclick="togglePopup_select_option('deactivate-2'); hide_previous('deactivate-1')"><img src="../images/16-deactivation/deactivate.png" alt=""></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </div>


  <!-- deactivate  popup - 2-->

  <div class="navigation-popup navigation-popup_set_time" id="deactivate-2">

    <div class="navigation-overlay"></div>

    <div class="navigation-content  navigation-popup_set_time" style="width: 300px; height: 300px;">
      <div class="navigation-close-btn" onclick="togglePopup_select_option('deactivate-2'); hide_previous('deactivate-1')">&times;</div>


      <div class="navigation-content_body  navigation-popup_set_time_body">
        <div class="navigation-popup_logo">
        <img src="../images/Name.svg" alt="" srcset="">
        </div>
        <hr>

        <div class="deactivate-2-down">
          <h3 class="deactivate-2-deactivation-form-header">Delete your account permanently.</h3>
          <div class="deactivate-2-deactivation-form">


          <br>

            <form action="../Control/deactivate.php" method="post">
                <input type="password" class="deactivate-2-input-1" placeholder="Password to Deactivate" required name='confirm_deactivate'>

                <input type='submit' value='Deactivate' class='update_btn otp_btn2' name = 'deactivate' style="margin-left:-0.5rem;">
            </form>

          </div>
        </div>

      </div>
    </div>

  </div>





  
  <!-- notifications -->

  <div class="navigation-popup  navigation-popup_set_time" id="notification">



    <div class="navigation-content  navigation-popup_set_time" style="width: 500px; height: auto; top: 44.5%; left: 80%; border:1px solid gray;">

      <div class="navigation-close-btn" onclick="togglePopup_select_option('notification')">&times;</div>

      <div class="navigation-content_body  navigation-popup_set_time_body">
        <div class="navigation-popup_form">
          <div class="navigation-btn_set_option">
            <?php
            include '../Model/connect.php';

            $USERID = $_SESSION['System_Actor_ID'];

            $variable_1 = "SELECT *FROM notification WHERE System_Actor_ID = '$USERID'  ORDER BY Post_ID DESC LIMIT 5";
            $variable_2 = $conn->query($variable_1);
            $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

            if ($variable_3) {
              foreach ($variable_3 as $variable_4) {

                $N_ID = $variable_4['Notification_ID']; 

                if ($variable_4['Approve_or_Reject'] == 'Approve') {
                  echo  "
                  <div class='navigation-notification'> <p>Your Post on " . $variable_4['Title'] . " has been accepted. </P> <i class='fas fa-check' style='text-align: right; color: green;'></i></div>                  
                  ";

                  

                } else {
                  echo  "
                  <div class='navigation-notification'> <p>Your Post on " . $variable_4['Title'] . " has been rejected. </P><button style = 'border: none;'><i class='fas fa-times' style='text-align: right; color: red;'></i></button></div>                  
                  ";
                }
              }
            } else {
              echo  "
                  <div class='navigation-notification'> <p>no notifications</p></div>                  
                  ";
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- select advertisement type-->

  <div class="navigation-popup  navigation-popup_set_time" id="popup-type">

    <div class="navigation-overlay"></div>

    <div class="navigation-content  navigation-popup_set_time" style="width: 300px; height: 360px;">
      <div class="navigation-close-btn" onclick="togglePopup_select_option('popup-type')">&times;</div>


      <div class="navigation-content_body  navigation-popup_set_time_body">
        <div class="navigation-popup_logo">
        <img src='../images/Name.svg'>
        </div>
        <hr>

        <div class="navigation-popup_form">
          <h3 class="navigation-popup_title">Select Option to Publish</h3>
          <div class="navigation-btn_set_option">

            <div class="navigation-select_option" onclick="window.open('N_User_Write_Notice.php','_self')">Notice</div>
            <div class="navigation-select_option" onclick="window.open('N_User_Write_Job_Vacancy.php','_self')">Job Advertisement</div>
            <div class="navigation-select_option" onclick="window.open('N_User_Write_Commercial_Advertisement.php','_self')">Commercial Advertisement</div>

          </div>


        </div>

      </div>
    </div>

  </div>




  <script>
  function togglePopup_select_option(id) {
    document.getElementById(id).classList.toggle("active");
  }

  function hide_previous(id) {
    document.getElementById(id).classList.toggle("navigation-hide");
  }
</script>





</body>
</html>