<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>NEWSLIA</title>
  <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/navigation.css">
  <link rel="stylesheet" href="../css/moderator.css">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/error.css">
  <link rel="stylesheet" href="../css/main_home.css">
  <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<style>
 
  body {
    overflow: hidden;
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

  .details-box {
    padding: 10px;
    margin: 5px;
    background-color: #EBEAEA;
    width: 150px;
    text-align: center;
  }

  .edit-btn {
    background-color: #ACE0B8;
    width: 50px;
    outline: none;
    height: 35px;
    border-radius: 5px;
    border: none;
  }


  /* nipun*/

  body {
    overflow: hidden;
    /* Hide scrollbars */
  }

  .error_body {
    color: #333;
  }

  .data {
    border: none;
    background-color: #EBEAEA;
    border-radius: 5px;
    color: #444;
    padding: 15px;
    margin-right: 3px;
    text-align: center;
    margin-bottom: 5px;
  }

  .data_edit {
    border: none;
    background-color: #ACE0B8;
    border-radius: 5px;
    color: #444;
    padding: 0.5rem;
    margin-right: 3px;
    text-align: center;
    transition: .5s ease;
  }

  .data_edit:hover {
    transform: scale(1.2);
    cursor: pointer;
  }

  .moderate_area_title {
    padding-left: -1rem;
  }

  table,
  th,
  td {
    vertical-align: top;
  }

  .tit {
    font-size: 1rem;
    padding: 0;
  }
</style>

<body>
  <!--navigation-->

  <?php $page = 'home';
  include 'nav.php'; ?>

  <!--End of Navigation-Bar-->

  <div class="content">

    <div class="content_left">
      <h1 style="padding-top: 50px; padding-bottom: 20px;">Welcome to the NEWSLIA <br> </h1>

      <div style="display: flex; margin-left: 8%;">
        <table class="moderator_details">
          <tr class="reading_area">
            <td class="reading_area_title tit">Reading Area</td>
            <td>
              <?php
              include '../Model/connect.php';
              $system_actor_id = $_SESSION['System_Actor_ID'];
              $reading_area_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$system_actor_id') ";

              $reading_area_statement = $conn->query($reading_area_sql);
              $reading_area_results = $reading_area_statement->fetchAll(PDO::FETCH_ASSOC);

              if ($reading_area_results) {

                foreach ($reading_area_results as $reading_area_result) {
                  echo "<button class='data'>" . $reading_area_result['Area'] . "</button>";
                }
              }
              ?>

             <button class="data_edit" onclick = "window.open('./Moderate_Area.php', '_self')">Edit</button>
            </td>
          </tr>


          <tr class="reading_area">
            <td class="reading_area_title tit">Reporting Area</td>
            <td>
              <?php
              include '../Model/connect.php';
              $system_actor_id = $_SESSION['System_Actor_ID'];
              $reading_area_sql = "SELECT * FROM report_area WHERE (System_Actor_Id = '$system_actor_id') ";

              $reading_area_statement = $conn->query($reading_area_sql);
              $reading_area_results = $reading_area_statement->fetchAll(PDO::FETCH_ASSOC);

              if ($reading_area_results) {

                foreach ($reading_area_results as $reading_area_result) {
                  echo "<button class='data'>" . $reading_area_result['Area'] . "</button>";
                }
              }
              ?>

            <button class="data_edit" onclick = "window.open('./Moderate_Area.php', '_self')">Edit</button>
            </td>
          </tr>


          <tr class="reading_type">
            <td class="reading_post_type tit">View Posts Type</td>
            <td>
              <?php
              include '../Model/connect.php';
              $system_actor_id = $_SESSION['System_Actor_ID'];
              $reading_type_sql = "SELECT * FROM post_type WHERE (System_Actor_Id = '$system_actor_id') ";

              $reading_type_statement = $conn->query($reading_type_sql);
              $reading_type_results = $reading_type_statement->fetchAll(PDO::FETCH_ASSOC);

              if ($reading_type_results) {

                foreach ($reading_type_results as $reading_type_result) {
                  if ($reading_type_result['News'] == 1) {
                    echo "<button class='data'>News</button>";
                  }
                  if ($reading_type_result['Article'] == 1) {
                    echo "<button class='data'>Articles</button>";
                  }
                  if ($reading_type_result['Notice'] == 1) {
                    echo "<button class='data'>Notices</button>";
                  }
                  if ($reading_type_result['Job_Vacancies'] == 1) {
                    echo "<button class='data'>Job Vacancies</button>";
                  }
                  if ($reading_type_result['Com_Ads'] == 1) {
                    echo "<button class='data'>Advertisements</button>";
                  }
                }
              }
              ?>

              <button class="data_edit" onclick = "window.open('./Moderate_Post_Type.php', '_self')">Edit</button>  
                     



            </td>
          </tr>

        </table>
      </div>

    </div>

    <div class="content_right">
      <img src="../images/Reporter.png" alt="" srcset="">
    </div>

  </div>

</body>

</html>