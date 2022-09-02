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
    <link rel="stylesheet" href="../css/select_area.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
   
</head>

<style>
  body {
     overflow-x: hidden; /* Hide scrollbars */
  }

  
  .column2 {
    float: right;
    width: 82%;
    height: 557px;
    margin-top:-44rem;
  }

  .posts_content_view_head{
    font-size:xx-large;
  }
  .right_side{
      margin-top:0rem;
      margin-left:1.7rem;
  }

  .first_box_area{
    height:250px;
   }

.second_box_area{
    height:250px;
}



.topic {
        position: relative;
        width: 300px;
        height: 23px;
        left: 86px;
        margin-top: 25px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 20px;
        line-height: 23px;
    }


    .arealist {
        position: relative;
        width: 30%;
        padding: 20px;
        margin: auto;
        height: 220px;
        overflow-y: scroll;
    }

    .arealist input {
        float: right;
    }


    .arealist h4 {
        font-size: 15px;
        position: relative;
        left: -20px;
    }

    .arealist h5 {
        font-size: 13px;
        color: #433D3D;
        position: relative;
        left: -7px;

    }

    .arealist li {
        display: list-item;
        list-style: inside;
        list-style-type: decimal;
        margin-top: 10px;
        font-size: 13px;
    }

    .btn_set{
      margin-top:-23rem;
      margin-left:75rem;
    }


  .prof_img{
      margin-top:-2rem;
      height:40%;
     
  }

  .prof_img img {
    position: relative;
    left: 30%;
    top: -280%;
  }

  .prof_img h3 {
    position: relative;
    left: 38%;
    margin-top: -50%;
    margin-left: -50px;
    font-style: normal;
    font-weight: bold;
    font-size: 17px;
    line-height: 21px;
  }




</style>


<body>

 
<!--navigation-->

<?php $page = 'home';
  include 'nav.php'; 
?>

<!--End of Navigation-Bar-->

<!-- Moderator Notices View -->


<div class="left_side">

  <div class="icon_left_side">

  <li><a href="Moderator_Profile.php"><img src="../images/other/profile.png" alt="" srcset=""><p>My Profile</p></a></li>
  
  <?php
      if($_SESSION['Actor_Type'] != "ADMIN"){
        echo "<li><a href='Moderate_Area.php'><img src='../images/other/location.png'><p>Select Area</p></a></li>";
      }
  ?>

  
  <li><a href="Moderate_Post_Type.php"><img src="../images/other/type.png" alt="" srcset=""><p style="color: #45ADA8EB;">Select Type</p></a></li>
  
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

          $img = $moderator_profile_result['Profile_Img'];
          $img = base64_encode($img);
          $text = pathinfo($moderator_profile_result['System_Actor_Id'], PATHINFO_EXTENSION);
      }
    }


  


  if($img != NULL){
      echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(0.7);margin-top:39rem;border-radius:10%;'>";
    }
  else{
      echo "<img src='../images/Profile.svg' style='transform:scale(2);margin-top:43rem;margin-left:5rem;margin-bottom:2rem;'>";
   }
          
          
  echo  "<h3>".$first." ".$last."</h3>";

  $post_type_sql = "SELECT * FROM post_type WHERE System_Actor_Id = '$Moderator_ID'";
  $post_type_statement = $conn->query($post_type_sql);
  $post_type_results = $post_type_statement ->fetchAll(PDO::FETCH_ASSOC);
  
  if($post_type_results){
    foreach($post_type_results as $post_type_result){
        echo "<hr style='margin-top: 45px;margin-left:2rem;'>
        </div>
           <br>
            <div class='topic'>
                <h3>Select Posts Type</h3>
            </div>
        
        
            <div class='arealist'>
                
            <form action='Moderate_Post_Type.php' method='post'>
                
                <input type='checkbox'";
                  if($post_type_result['News']==1){echo 'checked';}
                echo " class = 'post_type_chk' disabled name='News'>
                <label>
                  <h4>News</h4>
                </label>";

              
              $news_type_sql = "SELECT * FROM news_type WHERE System_Actor_Id = '$Moderator_ID'";
              $news_type_statement = $conn ->query($news_type_sql);
              $news_type_results = $news_type_statement ->fetchAll(PDO::FETCH_ASSOC);
              
              if($news_type_results){
                foreach($news_type_results as $news_type_result){
                      echo "<ol>
                      <li><input type='checkbox'";if($news_type_result['Political'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Political'><label>Political</label></li>
                      <li><input type='checkbox'";if($news_type_result['Crime'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Crime'><label>Crime</label></li>
                      <li><input type='checkbox'";if($news_type_result['Inves'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Inves'><label>Investigative</label></li>
                      <li><input type='checkbox'";if($news_type_result['Art'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Art'><label>Arts</label></li>
                      <li><input type='checkbox'";if($news_type_result['Eduation'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Eduation'><label>Entertainment</label></li>
                      <li><input type='checkbox'";if($news_type_result['Sport'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Sport'><label>Education</label></li>
                      <li><input type='checkbox'";if($news_type_result['Entertainment'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Entertainment'><label>Sports</label></li>
                      <li><input type='checkbox'";if($news_type_result['Environment'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Environment'><label>Environment</label></li>
                      <li><input type='checkbox'";if($news_type_result['Other'] == 1){echo "checked";}  echo " class = 'post_type_chk' disabled name='Other'><label>Other</label></li>
                    </ol>";
                }
              }
            
              echo  "<br>
                        <input type='checkbox'";
                          if($post_type_result['Article']==1){echo 'checked';}
                        echo " class = 'post_type_chk' disabled name='Article'>
                        <label>
                          <h4>Articles</h4>
                        </label>
                                    
                    <br>
                       <input type='checkbox'";
                        if($post_type_result['Notice']==1){echo 'checked';}
                       echo " class = 'post_type_chk' disabled name='Notice'>
                       <label>
                          <h4>Notices</h4>
                       </label>
                                    
                    <br>
                      <input type='checkbox'";
                       if($post_type_result['Job_Vacancies']==1){echo 'checked';}
                      echo " class = 'post_type_chk' disabled name='Job_Vacancies'>
                      <label>
                        <h4>Job Vacancies</h4>
                      </label>
        
                    <br>
                      <input type='checkbox'";
                        if($post_type_result['Com_Ads']==1){echo 'checked';}
                      echo " class = 'post_type_chk' disabled name='Com_Ads'>
                      <label>
                        <h4>Commercial Advertisements</h4>
                      </label>
        
          </div>
        </div>
        <div class='btn_set'>
           
           <input type='button' value='Edit' class='edit_btn_set' onclick='remove_disable()'>
           <br>
           <input type='submit' value='Save' class='save_btn_set' name = 'Save_POST'>

           </form>
        </div>
</div>";
      
    }
  }


  if(isset($_POST['Save_POST'])){

    $News = (isset($_POST['News']) == 1) ? 1 : 0;
    $Political = (isset($_POST['Political']) == 1) ? 1 : 0;
    $Inves = (isset($_POST['Inves']) == 1) ? 1 : 0;
    $Art = (isset($_POST['Art']) == 1) ? 1 : 0;
    $Eduation = (isset($_POST['Eduation']) == 1) ? 1 : 0;
    $Sport = (isset($_POST['Sport']) == 1) ? 1 : 0;
    $Entertainment = (isset($_POST['Entertainment']) == 1) ? 1 : 0;
    $Environment = (isset($_POST['Environment']) == 1) ? 1 : 0;
    $Crime = (isset($_POST['Crime']) == 1) ? 1 : 0;
    $Other = (isset($_POST['Other']) == 1) ? 1 : 0;

    $Article = (isset($_POST['Article']) == 1) ? 1 : 0;
    $Notice = (isset($_POST['Notice']) == 1) ? 1 : 0;
    $Job_Vacancies = (isset($_POST['Job_Vacancies']) == 1) ? 1 : 0;
    $Com_Ads = (isset($_POST['Com_Ads']) == 1) ? 1 : 0;

    
    if($News == 1){
      $Political = 1;
      $Inves = 1;
      $Art = 1;
      $Eduation = 1;
      $Sport = 1;
      $Entertainment = 1;
      $Environment = 1;
      $Crime = 1;
      $Other = 1;

    }

    $POST = [
      'Moderator_ID' => $Moderator_ID,
      'News' => $News,
      'Article' => $Article,
      'Notice' => $Notice,
      'Job_Vacancies' => $Job_Vacancies,
      'Com_Ads' => $Com_Ads
    ];
    
    $sql_1 = 'UPDATE post_type
            SET News = :News, Article = :Article, Notice = :Notice, Job_Vacancies = :Job_Vacancies, Com_Ads = :Com_Ads 
            WHERE System_Actor_Id = :Moderator_ID';
    
    // prepare statement
    $statement_1 = $conn->prepare($sql_1);
    
    // bind params
    $statement_1->bindParam(':Moderator_ID', $POST['Moderator_ID']);
    $statement_1->bindParam(':News', $POST['News'],PDO::PARAM_INT);
    $statement_1->bindParam(':Article', $POST['Article'],PDO::PARAM_INT);
    $statement_1->bindParam(':Notice', $POST['Notice'],PDO::PARAM_INT);
    $statement_1->bindParam(':Job_Vacancies', $POST['Job_Vacancies'],PDO::PARAM_INT);
    $statement_1->bindParam(':Com_Ads', $POST['Com_Ads'],PDO::PARAM_INT);
    
    // execute the UPDATE statment
    $statement_1->execute();
       
    

    $POST = [
      'Moderator_ID' => $Moderator_ID,
      'Political' => $Political,
      'Crime' => $Crime,
      'Inves' => $Inves,
      'Art' => $Art,
      'Eduation' => $Eduation,
      'Sport' => $Sport,
      'Entertainment' => $Entertainment,
      'Environment' => $Environment,
      'Other' => $Other
    ];
    
    $sql_2 = 'UPDATE news_type
            SET Political = :Political, Crime = :Crime, Inves = :Inves, Art = :Art, Eduation = :Eduation, 
            Sport = :Sport, Entertainment = :Entertainment, Environment = :Environment, Other = :Other 
            WHERE System_Actor_Id = :Moderator_ID';
    
    // prepare statement
    $statement_2 = $conn->prepare($sql_2);
    
    // bind params
    $statement_2->bindParam(':Moderator_ID', $POST['Moderator_ID']);
    $statement_2->bindParam(':Political', $POST['Political'],PDO::PARAM_INT);
    $statement_2->bindParam(':Crime', $POST['Crime'],PDO::PARAM_INT);
    $statement_2->bindParam(':Inves', $POST['Inves'],PDO::PARAM_INT);
    $statement_2->bindParam(':Art', $POST['Art'],PDO::PARAM_INT);
    $statement_2->bindParam(':Eduation', $POST['Eduation'],PDO::PARAM_INT);
    $statement_2->bindParam(':Sport', $POST['Sport'],PDO::PARAM_INT);
    $statement_2->bindParam(':Entertainment', $POST['Entertainment'],PDO::PARAM_INT);
    $statement_2->bindParam(':Environment', $POST['Environment'],PDO::PARAM_INT);
    $statement_2->bindParam(':Other', $POST['Other'],PDO::PARAM_INT);
    
    // execute the UPDATE statment
    if($statement_2->execute()){
        echo "<script>window.open('./Moderate_Post_Type.php','_self'); </script>";
    }



  }


?>


<script>
    function remove_disable(){
      var input = document.getElementsByClassName('post_type_chk');
      for (var i = 0; i < input.length; i++) {
                input[i].disabled = false;
            }
    }
</script>
   
</body>
</html>