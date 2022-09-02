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
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../css/main_home.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
</head>

<style>
  body {
  overflow: hidden; /* Hide scrollbars */
  }
  .error_body{
    color:#333;
  }

  .data{
      border:none;
      background-color:#EBEAEA;dxcx
      border-radius: 5px;
      color:#444;
      padding:0.5rem;
      margin-right:3px;
      text-align:center;
      margin-bottom:5px;
  }

  .data_edit{
      border:none;
      background-color:#ACE0B8;
      border-radius: 5px;
      color:#444;
      padding:0.5rem;
      margin-right:3px;
      text-align:center;
      transition: .5s ease;
  }

  .data_edit:hover{
      transform:scale(1.2);
      cursor:pointer;
  }
.moderate_area_title{
    padding-left: -1rem;
}
table, th, td {
  vertical-align: top;
}

.tit{
  font-size:1rem;
  padding:0;
}

.content_right{
  margin-top:-4rem;
  z-index: -1;
}

</style>

<body>

  


<!--navigation-->

<?php $page = 'home';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


<?php
    
    include '../Model/connect.php';
    $currentDate = date('Y-m-d');
    
    $sql_reminder = "SELECT * FROM reminder WHERE Reminder_Date = '$currentDate'";
    $state_reminder = $conn->query($sql_reminder);
    $results_reminder = $state_reminder -> fetchAll(PDO::FETCH_ASSOC);

    if($results_reminder){
      foreach($results_reminder as $result_reminder){

        $UserID = $result_reminder['System_Actor_ID'];
        $PostID = $result_reminder['Post_ID'];
        $PostType = $result_reminder['Post_Type'];

        $Email = "";
        $Title = "";
        $Details = "";
        
        $email_sql = "SELECT Email FROM login WHERE System_Actor_ID = '$UserID'";
        $email_statement = $conn->query($email_sql);
        $email_results = $email_statement -> fetchAll(PDO::FETCH_ASSOC);

        if($email_results){
          foreach($email_results as $email_result){
            $Email = $email_result['Email'];
          }
        }

        if($PostType == "NOTICES"){
          $post_sql = "SELECT * FROM notices WHERE Post_ID = '$PostID'";
        }
        elseif($PostType == "VACANCIES"){
          $post_sql = "SELECT * FROM job_vacancies WHERE Post_ID = '$PostID'";
        }
        elseif($PostType == "C.ADS"){
          $post_sql = "SELECT * FROM com_ads WHERE Post_ID = '$PostID'";
        }

        $post_statement = $conn->query($post_sql);
        $post_results = $post_statement -> fetchAll(PDO::FETCH_ASSOC);

        if($post_results){
          foreach($post_results as $post_result){
              $Title = $post_result['Title'];
              $Details = $post_result['Details'];
          }
        }

        //the subject
        $sub = $Title;
        //the message
        $msg = $Details;

        //send email
        $send_result = mail($Email,$sub,$msg);

        if($send_result){
          
          $query = "DELETE FROM reminder WHERE Post_ID = :ID";
          $query_statement = $conn->prepare($query);
          $query_statement->bindParam(':ID',$PostID);
          $query_statement->execute();    
             
        }

      }
    }
    

?>


<!-- Moderator Page Content -->

  <div class="content">

        <div class="content_left">
          <h1>Welcome to the NEWSLIA</h1>
              
          <div class="moderate_info">
              <table class="moderator_details">

                  <tr class="moderate_area">
                    <td class="moderate_area_title tit">Moderating Area</td>
                    <td>
                        <?php
                          include '../Model/connect.php';
                          $system_actor_id = $_SESSION['System_Actor_ID'];
                          $moderating_area_sql = "SELECT * FROM moderate_area WHERE (System_Actor_Id = '$system_actor_id') ";
                          
                          $moderating_area_statement = $conn -> query($moderating_area_sql);
                          $moderating_area_results = $moderating_area_statement->fetchAll(PDO::FETCH_ASSOC);

                          if($moderating_area_results){
                            
                            foreach($moderating_area_results as $moderating_area_result){
                                $_SESSION['moderate_area'] = $moderating_area_result['Area'];
                                echo "<button class='data'>".$moderating_area_result['Area']."</button>";
                            
                            }
                          }
                        ?>

                        <button class="data_edit" onclick = "window.open('./Moderate_Area.php', '_self')">Edit</button>

                    </td>
                  </tr>

                  <tr class="reading_area">
                    <td class="reading_area_title tit">Reading Area</td>
                    <td>
                    <?php
                          include '../Model/connect.php';
                          $system_actor_id = $_SESSION['System_Actor_ID'];
                          $reading_area_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$system_actor_id') ";
                          
                          $reading_area_statement = $conn -> query($reading_area_sql);
                          $reading_area_results = $reading_area_statement->fetchAll(PDO::FETCH_ASSOC);

                          if($reading_area_results){
                            
                            foreach($reading_area_results as $reading_area_result){
                                echo "<button class='data'>".$reading_area_result['Area']."</button>";
                            
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
                          
                          $reading_type_statement = $conn -> query($reading_type_sql);
                          $reading_type_results = $reading_type_statement->fetchAll(PDO::FETCH_ASSOC);

                          if($reading_type_results){
                            
                            foreach($reading_type_results as $reading_type_result){
                                if ($reading_type_result['News'] == 1){
                                  echo "<button class='data'>News</button>";
                                }
                                if ($reading_type_result['Article'] == 1){
                                  echo "<button class='data'>Articles</button>";
                                }
                                if ($reading_type_result['Notice'] == 1){
                                  echo "<button class='data'>Notices</button>";
                                }
                                if ($reading_type_result['Job_Vacancies'] == 1){
                                  echo "<button class='data'>Job Vacancies</button>";
                                }
                                if ($reading_type_result['Com_Ads'] == 1){
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
            <img src="../images/Moderator.png" alt="" srcset="">
        </div>

  </div>


  
  <div class="errorbox active" id="error2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Welcome to the Moderator HomePage.</div>
       <div class="error_foot" onclick="moderator_login()">OK</div>

  </div>
</div>


<script>
    function moderator_login(){
      document.getElementById("error2").classList.remove("active");
    } 
</script>
    
</body>
</html>