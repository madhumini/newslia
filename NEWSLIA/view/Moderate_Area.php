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
      margin-top:1rem;
      margin-left:1.7rem;
      height:500px;
  }

  .first_box_area{
    height:250px;
   }

.second_box_area{
    height:250px;
}

.bottom_side{
  margin-top:0.5rem;
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
  <li><a href="Moderate_Area.php"><img src="../images/other/location.png" alt="" srcset=""><p style="color: #45ADA8EB;">Select Area</p></a></li>
  <li><a href="Moderate_Post_Type.php"><img src="../images/other/type.png" alt="" srcset=""><p>Select Type</p></a></li>
  <?php
      if($_SESSION['Actor_Type'] != "NORMALUSER"){
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


echo "<div class='right_side'>
    <hr>
    <div class='bottom_side'>
    
        <div class='first_box'>
            <h2>Reading Area</h2>

            <div class='first_box_area'>";

                          $READ_AREA=array();
                          $y=0;
              
                          $system_actor_id = $_SESSION['System_Actor_ID'];

                          $reading_area_check_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$system_actor_id') ";
                          $reading_area_check_statement = $conn -> query($reading_area_check_sql);
                          $reading_area_check_results = $reading_area_check_statement->fetchAll(PDO::FETCH_ASSOC);

                          if($reading_area_check_results){
                            foreach ($reading_area_check_results as $reading_area_check_result){
                                $READ_AREA[$y] = $reading_area_check_result['Area'];
                                $y++;
                            }
                          }

                    
                          $count = count($READ_AREA);

                          $read_province_area_sql = "SELECT * FROM dsa ORDER BY DSA ASC";
                          $read_province_area_statement = $conn -> query($read_province_area_sql);
                          $read_province_area_results = $read_province_area_statement->fetchAll(PDO::FETCH_ASSOC);
                          
                          echo "<form action='Moderate_Area.php' method='POST'>";

                          if($read_province_area_results){
                                  
                            $i = 350;
                            foreach($read_province_area_results as $read_province_area_result){

                              $flag = 0;
                              for ($x = 0; $x < $count; $x++) {
                                if($READ_AREA[$x] == $read_province_area_result['DSA']){
                                  $flag = 1;
                                }
                              } 
                              
                              echo " <input type='checkbox' id='".$i."' value='".$read_province_area_result['DSA']."' name='read_area_select[]' disabled class='moderator_read_radio'"; 
                              if($flag == 1){echo 'checked';} 
                              echo "> 
                              <label for='".$i."'>".$read_province_area_result['DSA']."</label>
                              <br>";
                              
                              $i = $i +1;  
                            }
                      }
                    

          echo "</div>

                <div class='btn_set'>
                    
                    <input type='button' value='Edit' class='edit_btn_set' onclick='remove_read_disable()'>
                  <br>
                    <input type='submit' value='Save' class='save_btn_set' name = 'Save_READ'>
               </div>
               </form>";
      ?>
        </div>
        
        <?php
        if($_SESSION['Actor_Type'] == "MODERATOR"){
              echo "<div class='second_box'>
              <h2>Moderating Area</h2>

              <div class='second_box_area'>";
                
                      include '../Model/connect.php';
                      $moderate_area_sql = "SELECT * FROM dsa ORDER BY DSA ASC";
                    
                      $moderate_area_statement = $conn -> query($moderate_area_sql);
                      $moderate_area_results = $moderate_area_statement->fetchAll(PDO::FETCH_ASSOC);

                      if($moderate_area_results){
                              
                        $i = 1;
                        foreach($moderate_area_results as $moderate_area_result){


                          $system_actor_id = $_SESSION['System_Actor_ID'];
                          
                          $moderate_area_check_sql = "SELECT * FROM moderate_area WHERE (System_Actor_Id = '$system_actor_id') ";
                          $moderate_area_check_statement = $conn -> query($moderate_area_check_sql);
                          $moderate_area_check_results = $moderate_area_check_statement->fetchAll(PDO::FETCH_ASSOC);

                          echo "<form action='Moderate_Area.php' method='POST'>";

                          if($moderate_area_check_results){
                            foreach($moderate_area_check_results as $moderate_area_check_result){

                                echo " <input type='radio' id='".$i."' value='".$moderate_area_result['DSA']."' name='moderate_area_select' disabled class='moderator_radio'"; 
                                if($moderate_area_check_result['Area'] == $moderate_area_result['DSA']){echo 'checked';} 
                                echo "> 
                                <label for='".$i."'>".$moderate_area_result['DSA']."</label>
                                <br>";

                              }
                            }
                          }
                          $i = $i +1;   
                        }
                  
              echo "</div>  

              <div class='btn_set'>
                  <input type='button' value='Edit' class='edit_btn_set' onclick='remove_disable()'>
                    <br>
                  <input type='submit' value='Save' class='save_btn_set' name = 'Save_MODERATOR'>
                </form>
              </div>";

        }

        if($_SESSION['Actor_Type'] == "REPORTER"){
          echo "<div class='second_box'>
          <h2>Reporting Area</h2>

          <div class='second_box_area'>";
                $REPORT_AREA=array();
                $y=0;

                $system_actor_id = $_SESSION['System_Actor_ID'];

                $report_area_check_sql = "SELECT * FROM report_area WHERE (System_Actor_Id = '$system_actor_id') ";
                $report_area_check_statement = $conn -> query($report_area_check_sql);
                $report_area_check_results = $report_area_check_statement->fetchAll(PDO::FETCH_ASSOC);

                if($report_area_check_results){
                  foreach ($report_area_check_results as $report_area_check_result){
                      $REPORT_AREA[$y] = $report_area_check_result['Area'];
                      $y++;
                  }
                }

          
                $count = count($REPORT_AREA);

                $read_province_area_sql = "SELECT * FROM dsa ORDER BY DSA ASC";
                $read_province_area_statement = $conn -> query($read_province_area_sql);
                $read_province_area_results = $read_province_area_statement->fetchAll(PDO::FETCH_ASSOC);
                
                echo "<form action='Moderate_Area.php' method='POST'>";

                if($read_province_area_results){
                        
                  $j = 350;
                  foreach($read_province_area_results as $read_province_area_result){

                    $flag = 0;
                    for ($x = 0; $x < $count; $x++) {
                      if($REPORT_AREA[$x] == $read_province_area_result['DSA']){
                        $flag = 1;
                      }
                    } 
                    
                    echo " <input type='checkbox' id='".$j."' value='".$read_province_area_result['DSA']."' name='report_area_select[]' disabled class='repoter_report_radio'"; 
                    if($flag == 1){echo 'checked';} 
                    echo "> 
                    <label for='".$j."'>".$read_province_area_result['DSA']."</label>
                    <br>";
                    
                    $j = $j +1;  
                  }
            }
                  
              
          echo "</div>  

          <div class='btn_set'>
              <input type='button' value='Edit' class='edit_btn_set' onclick='remove_disable_report()'>
                <br>
              <input type='submit' value='Save' class='save_btn_set' name = 'Save_REPORTE'>
            </form>
          </div>";

        }
        
        

              if(isset($_POST['Save_MODERATOR']) and isset($_POST['moderate_area_select']) ){

                  
                 $Area = $_POST['moderate_area_select'];
                  
                  $MAREA = [
                    'Moderator_ID' => $Moderator_ID,
                    'Area' => $Area
                  ];
                  
                  $sql_2 = 'UPDATE moderate_area
                          SET Area = :Area
                          WHERE System_Actor_Id = :Moderator_ID';
                  
                  // prepare statement
                  $statement_2 = $conn->prepare($sql_2);
                  
                  // bind params
                  $statement_2->bindParam(':Moderator_ID', $MAREA['Moderator_ID']);
                  $statement_2->bindParam(':Area', $MAREA['Area']);
                  
                  // execute the UPDATE statment
                  if($statement_2->execute()){
                    echo "<script> window.open('./Moderate_Area.php','_self'); </script>";
                }
                  
              }


              if(isset($_POST['Save_READ']) and isset($_POST['read_area_select']) ){
                    
                    // construct the delete statement
                    $sql = 'DELETE FROM read_area
                            WHERE System_Actor_Id = :Moderator_ID';
                    
                    // prepare the statement for execution
                    $statement = $conn->prepare($sql);
                    $statement->bindParam(':Moderator_ID', $Moderator_ID);
                    
                    // execute the statement
                    if ($statement->execute()) {
                      
                      foreach($_POST['read_area_select'] as $item) {
                          $stmt = $conn->prepare("INSERT INTO `read_area` VALUES(?,?)");
                          $stmt->execute([$Moderator_ID,$item]);
                          echo "<script> window.open('./Moderate_Area.php','_self'); </script>";
                      }
                    }   
              }


              if(isset($_POST['Save_REPORTE']) and isset($_POST['report_area_select']) ){
                    
                // construct the delete statement
                $sql = 'DELETE FROM report_area
                        WHERE System_Actor_Id = :REPORTER_ID';
                
                // prepare the statement for execution
                $statement = $conn->prepare($sql);
                $statement->bindParam(':REPORTER_ID', $Moderator_ID);
                
                // execute the statement
                if ($statement->execute()) {
                  
                  foreach($_POST['report_area_select'] as $item) {
                      echo "<script> alert(".$item."); </script>";
                      $stmt = $conn->prepare("INSERT INTO `report_area` VALUES(?,?)");
                      $stmt->execute([$Moderator_ID,$item]);
                  }
                  echo "<script> window.open('./Moderate_Area.php','_self'); </script>";
                }   
          }

            ?>


        </div>  

    </div>

</div>


</div>

</div>


<script>
    function remove_disable(){
      var input = document.getElementsByClassName('moderator_radio');
      for (var i = 0; i < input.length; i++) {
                input[i].disabled = false;
            }
    }

    function remove_disable_report(){
      var input = document.getElementsByClassName('repoter_report_radio');
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


</script>
   
</body>
</html>