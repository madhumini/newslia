<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NEWSLIA</title>
  <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/navigation.css">
  <link rel="stylesheet" href="../css/moderator.css">
  <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
</head>

<style>
  


  body {
    font-family: 'Sora', sans-serif;
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

  .box_head:hover img {
    opacity: 1;
  }
</style>

<body>
  <!--navigation-->

  <?php $page = 'articles';
  include 'nav.php'; ?>

  <!--End of Navigation-Bar-->

  <div class="content_posts_view">
    <div class="posts_content_view_head" style="font-size: x-large;">
      My Articles
    </div>



  </div>

  </div>

  <div class="posts_content_view_body">
    <div class="body_information" style="display: flex;">

      <div class="box-container" style="margin-right: 20px; margin-bottom: 20px;">
        <div class="box_head">
          <img src="../images/heen-bin-kohomba.jpg" alt="" style="    height: 160px;">
        </div>
        <div style="    display: flex; justify-content: space-between; align-items: flex-start;">
          <div class="box_body">
            <h3>Bin Kohomba</h3>
            <p>2020-12-30</p>
          </div>
          <div class="view_btn" style="margin-top: 10px;  margin-right: 10px;">View</div>
        </div>


      </div>

    </div>
  </div>

</body>

</html>