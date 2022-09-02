<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEWSLIA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/navigation.css">
  <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico">
  <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<style>
  body {
    font-family: 'Sora', sans-serif;
    overflow: hidden; 
  }

  .profile-menu-container {
    margin-right: 160px;
  }

  .down {
    margin-left: 2px;
  }

  .fa-customize {
    font-size: 22px;
    color: black;
  }

  .input-field {
    background-color: #eeeeee;
    padding: 8px;
    border: none;
    outline: none;
    font-size: 15px;
    padding-left: 20px;
    width: 80%;
  }

  .write-article-btn {
    padding: 8px;
    width: 150px;
    border: none;
    outline: none;
    border-radius: 7px;
    cursor: pointer;
    margin-left: 20px;
    font-size: 18px;
    transition: .5s ease;

  }

  .write-article-btn :hover {
    transform: scale(1.2);
  }
</style>

<body>
  <!--navigation-->

  <?php $page = 'articles';
  include 'nav.php'; ?>

  <!--End of Navigation-Bar-->

  <div style="margin-top: 40px; margin-left: 40px;">
    <form action="N_User_Pending_Posts.php" method="post" enctype="multipart/form-data">
      <div style="display: flex; justify-content: space-between; margin-top: 15px;">
        <div style="width: 15%;">
          <h3>Title :-</h3>
        </div>
        <div style="width: 85%;">
          <input type="text" name="Title" class="input-field" required>
        </div>
      </div>



      <div style="display: flex; justify-content: space-between; margin-top: 15px;">
        <div style="width: 15%;">
          <h3>Content :-</h3>
        </div>
        <div style="width: 85%;">
          <div class="container">
            <div style="width: 95%;">
              <textarea class="ckeditor" name="Content" required></textarea>
            </div>
          </div>
        </div>
      </div>


      <div style="display: flex; justify-content: space-between; margin-top: 15px;">
        <div style="width: 15%;">
          <h3>Add Images :-</h3>
        </div>
        <div style="width: 85%;">
          <div class="input-field">
            <input type="file" name="Image" required>
          </div>
        </div>
      </div>


      <div style=" margin-bottom: 150px; margin-top: 60px; text-align: end; margin-right: 50px; display: flex; justify-content: flex-end;">
        <input type="submit" value="Draft" class="write-article-btn" style="background-color: #45ADA8EB;" name="D_A_Submit">
        <input type="submit" value="Send" class="write-article-btn" style="background-color: #00B172EB;" name="P_A_submit">
        <div class="write-article-btn" style=" background-color: #FF4444EB; text-align: center " onclick="togglePopup_select_option('confirm_delete_article')">Delete</div>
      </div>

    </form>


    <!-- confirm delete popup-->

    <div class="navigation-popup  navigation-popup_set_time" id="confirm_delete_article">
      <div class="navigation-overlay"></div>
      <div class="navigation-content  navigation-popup_set_time" style="width: 300px; height: 280px;">
        <div class="navigation-content_body  navigation-popup_set_time_body">
          <div class="navigation-popup_logo">
          <img src="../images/Name.svg" alt="" srcset="">
          </div>

          <hr>

          <div class="navigation-popup_form">
            <h3 class="navigation-popup_title" style="text-align: center;">Sure to Delete</h3>
            <div class="navigation-btn_set_option">

              <div class="navigation-select_option" onclick="window.open('./N_User_Pending_Posts.php','_self')" style="text-align: center; font-weight: bold; background-color: #FF4444EB;">Yes</div>
              <div class="navigation-select_option"  onclick="togglePopup_select_option('confirm_delete_article')" style="text-align: center; font-weight: bold;">No</div>

            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

</body>

<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('content');
</script>

<script>
    function togglePopup_select_option(id) {
    document.getElementById(id).classList.toggle("active");
  }
</script>



</html>