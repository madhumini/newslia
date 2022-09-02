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
      background-color:#EBEAEA;
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
  /*margin-top:-4rem;*/
  z-index: -1;
}

</style>

<body>

  


<!--navigation-->

<?php $page = 'home';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


<!-- Moderator Page Content -->

  <div class="content">

        <div class="content_left">
          <h1>Welcome to the NEWSLIA</h1>
              
          <div class="moderate_info">
              <table class="moderator_details">



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
          <img src="../images/Normal_User.png" alt="" srcset="">
        </div>

  </div>


  
  <div class="errorbox active" id="error2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Welcome to the Admin HomePage.</div>
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