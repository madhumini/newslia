<?php
  session_start();
  date_default_timezone_set("Asia/Calcutta");
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
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  
  .post_sort{
      padding-left:80px;
  }
  .box-container{
    height: 290px;
  }

  .more{
      font-size:14px;
      text-align:right;
      margin-top:-14%;
      display:flex;
      flex-direction:row;
      
  }
  .more p{
    margin-left:5%;
  }

  .setting_close{
    transform:scale(2);
    margin-left:78%;
    margin-top :-7%;
  }
  .setting_close img{
    padding-right:5px;
    cursor: pointer;
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
    transform:scale(1.07);
  
  }

  .tag {
      position: absolute;
      top: 1.3%;
      bottom: 0;
      left: 20;
      right: 1%;
      height: 15%;
      width: 30%;
      opacity: 1;
      transition: .5s ease;
      background-color: #ACE0B8;
      cursor: pointer;
      border-radius:0px 0px 0px 20px;
  }
  .box_head:hover .tag{
      opacity: 1;
  } 

  .tag_text{
      color: #555;
      font-weight:bold;
      font-size: 15px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
  }

  .view_btn ul{
    list-style-type: none;
  }

  .view_btn ul a{
    text-decoration:none;
    color:#333;
  }





</style>

<body>


<!--navigation-->

<?php $page = 'publish';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Set Time Posts
    </div>

    <div class="post_sort">
        <div class="post_sort_bar">
          <button onclick="showsort()" class="drop_area_sort">Select Post Type<img src="../images/sort.svg" alt="" srcset=""></button>
          <div class="drop_area_sort_cont" id="sortdrop">
            <img src="../images/search.svg" alt="" srcset="">
            <input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Search...">
            
          </div>
        </div>
      </div>
      
     
  
    
</div>

<div class="posts_content_view_body">

    <div class="body_information" id="content_sort">
         
          <?php
            include '../Model/connect.php';
            $Moderator_Area = $_SESSION['moderate_area'];

            
//Notices
      $settime_post_sql = "SELECT * FROM notices";
      $settime_post_statement = $conn -> query($settime_post_sql);
      $settime_post_results = $settime_post_statement->fetchAll(PDO::FETCH_ASSOC);

      if($settime_post_results){
        foreach($settime_post_results as $settime_post_result){
            $Post_ID = $settime_post_result['Post_ID'];
                  
            $flag = 0;
            $Availble = 0;
            $Area = array();
            $y=0;
            $Type = "Notices";

            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  if($post_from_result['Area'] == $Moderator_Area){
                      $Availble = 1;
                  }
                  $Area[$y] = $post_from_result['Area'];
                  $y++;
                }
            }

            if($Availble == 1){

              $System_Date = date("Y-m-d");
              $Set_Date = $settime_post_result['Set_Date'];


              $System_Time = date("H:i:s");
              $Set_Time = $settime_post_result['Set_Time'];

              if($Set_Time != NULL and $Set_Date != NULL){
                  if($System_Date<$Set_Date){
                    $flag = 1;
                  }
                  elseif($System_Date == $Set_Date and $System_Time < $Set_Time){
                    $flag = 1;
                  }
              }
            }                
            if($flag == 1){
                $img = $settime_post_result['Image'];
                $img = base64_encode($img);
                $text = pathinfo($settime_post_result['Post_ID'], PATHINFO_EXTENSION);

                $Creator_ID = $settime_post_result['Creator_ID'];
                $Title = $settime_post_result['Title'];
                $Publish_Date = $settime_post_result['Set_Date'];
                $Publish_Time = $settime_post_result['Set_Time'];

                echo "
                  <div class='box-container'>
                      <div class='box_head'>
                        
                        <img src='data:image/".$text.";base64,".$img."'/>
                        
                        <div class='tag'>
                            <div class='tag_text'><abc>Notices</abc></div>
                        </div>

                        <div class='middle'>
                              <div class='view_btn'>
                                   <ul>
                                      <li onclick=toggle_view('$Post_ID','Notices');><a href='#'>View</a></li>
                                   </ul>   
                               </div>  
                        </div>
                        

                      </div>

                      <div class='box_body'>
                        <h3>".$Title."</h3>";
                      
                          echo "<p><b><i>-</i>";
                            foreach ($Area as $value) {
                                echo "<i>".$value." - ";
                                echo "</i>";
                            } 
                          echo "</b></p>";

                          $set_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $set_who_state = $conn->query($set_who_sql);
                          $set_who_results = $set_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($set_who_results){
                            foreach($set_who_results as $set_who_result){
                              echo "<p>".$set_who_result['FirstName']." ".$set_who_result['LastName']."</p>";    
                            }
                          }

                          echo "<p>".$Publish_Date." ".$Publish_Time."</p>";
                            
                          echo "<div class='setting_close'>
                                <img src='../images/Setting.svg' onclick = togglePopupUpdate_add('$Post_ID','Notices','$Publish_Date','$Publish_Time')>
                                <img src='../images/Close.svg' onclick = togglePopupremove_add('$Post_ID','Notices')>
                              </div>";
                            
                          echo "</div>
                          </div>";
                  }   
              }
            }




//Job Vacancies
      $settime_post_sql = "SELECT * FROM job_vacancies";
      $settime_post_statement = $conn -> query($settime_post_sql);
      $settime_post_results = $settime_post_statement->fetchAll(PDO::FETCH_ASSOC);

      if($settime_post_results){
        foreach($settime_post_results as $settime_post_result){
            $Post_ID = $settime_post_result['Post_ID'];
                  
            $flag = 0;
            $Availble = 0;
            $Area = array();
            $y=0;
            $Type = "Vacancies";

            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  if($post_from_result['Area'] == $Moderator_Area){
                      $Availble = 1;
                  }
                  $Area[$y] = $post_from_result['Area'];
                  $y++;
                }
            }


            if($Availble == 1){

              $System_Date = date("Y-m-d");
              $Set_Date = $settime_post_result['Set_Date'];


              $System_Time = date("H:i:s");
              $Set_Time = $settime_post_result['Set_Time'];

              if($Set_Time != NULL and $Set_Date != NULL){
                  if($System_Date<$Set_Date){
                    $flag = 1;
                  }
                  elseif($System_Date == $Set_Date and $System_Time < $Set_Time){
                    $flag = 1;
                  }
              }
            }
       
            if($flag == 1){
                $img = $settime_post_result['Image'];
                $img = base64_encode($img);
                $text = pathinfo($settime_post_result['Post_ID'], PATHINFO_EXTENSION);

                $Creator_ID = $settime_post_result['Creator_ID'];
                $Title = $settime_post_result['Title'];
                $Company = $settime_post_result['Company'];
                $Publish_Date = $settime_post_result['Set_Date'];
                $Publish_Time = $settime_post_result['Set_Time'];
                
                echo "
                  <div class='box-container'>
                      <div class='box_head'>
                        
                        <img src='data:image/".$text.";base64,".$img."'/>
                        
                        <div class='tag'>
                            <div class='tag_text'><abc>Vacancies></abc></div>
                        </div>

                        <div class='middle'>
                              <div class='view_btn'>
                                   <ul>
                                      <li onclick=toggle_view('$Post_ID','Vacancies');><a href='#'>View</a></li>
                                   </ul>   
                               </div>  
                        </div>
                          
                        

                      </div>

                      <div class='box_body'>
                        <h3>".$Title." (".$Company.")</h3>";
                      
                          echo "<p><b><i>-</i>";
                            foreach ($Area as $value) {
                                echo "<i>".$value." - ";
                                echo "</i>";
                            } 
                          echo "</b></p>";

                          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $save_who_state = $conn->query($save_who_sql);
                          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_who_results){
                            foreach($save_who_results as $save_who_result){
                              echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                            }
                          }

                          echo "<p>".$Publish_Date." ".$Publish_Time."</p>";
                                
                          echo "<div class='setting_close'>
                            <img src='../images/Setting.svg' onclick = togglePopupUpdate_add('$Post_ID','Vacancies','$Publish_Date','$Publish_Time')>
                            <img src='../images/Close.svg' onclick = togglePopupremove_add('$Post_ID','Vacancies')>
                          </div>";
                            
                          echo "</div>
                          </div>";
                  }   
              }
            }

//Com. Advertisment
        $settime_post_sql = "SELECT * FROM com_ads";
        $settime_post_statement = $conn -> query($settime_post_sql);
        $settime_post_results = $settime_post_statement->fetchAll(PDO::FETCH_ASSOC);

        if($settime_post_results){
          foreach($settime_post_results as $settime_post_result){
              $Post_ID = $settime_post_result['Post_ID'];
                    
              $flag = 0;
              $Availble = 0;
              $Area = array();
              $y=0;
              $Type = "C.Ads";

              $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
              $post_from_state = $conn->query($post_from_sql);
              $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

              if($post_from_results){
                  foreach($post_from_results as $post_from_result){
                    if($post_from_result['Area'] == $Moderator_Area){
                        $Availble = 1;
                    }
                    $Area[$y] = $post_from_result['Area'];
                    $y++;
                  }
              }


              if($Availble == 1){

                $System_Date = date("Y-m-d");
                $Set_Date = $settime_post_result['Set_Date'];
  
                $System_Time = date("H:i:s");
                $Set_Time = $settime_post_result['Set_Time'];
  
                if($Set_Time != NULL and $Set_Date != NULL){
                    if($System_Date<$Set_Date){
                      $flag = 1;
                    }
                    elseif($System_Date == $Set_Date and $System_Time < $Set_Time){
                      $flag = 1;
                    }
                }
              }
                    
              if($flag == 1){
                  $img = $settime_post_result['Image'];
                  $img = base64_encode($img);
                  $text = pathinfo($settime_post_result['Post_ID'], PATHINFO_EXTENSION);

                  $Creator_ID = $settime_post_result['Creator_ID'];
                  $Title = $settime_post_result['Title'];
                  $Publish_Date = $settime_post_result['Set_Date'];
                  $Publish_Time = $settime_post_result['Set_Time'];
                  
                  echo "
                    <div class='box-container'>
                        <div class='box_head'>
                          
                          <img src='data:image/".$text.";base64,".$img."'/>
                          
                          <div class='tag'>
                              <div class='tag_text'><abc>Ads</abc></div>
                          </div>

                          <div class='middle'>
                              <div class='view_btn'>
                                   <ul>
                                      <li onclick=toggle_view('$Post_ID','C.Ads');><a href='#'>View</a></li>
                                   </ul>   
                               </div>  
                          </div>
                          

                        </div>

                        <div class='box_body'>
                          <h3>".$Title."</h3>";
                        
                            echo "<p><b><i>-</i>";
                              foreach ($Area as $value) {
                                  echo "<i>".$value." - ";
                                  echo "</i>";
                              } 
                            echo "</b></p>";

                            $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                            $save_who_state = $conn->query($save_who_sql);
                            $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                            if($save_who_results){
                              foreach($save_who_results as $save_who_result){
                                echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                              }
                            }

                            echo "<p>".$Publish_Date." ".$Publish_Time."</p>";

                            echo "<div class='setting_close'>
                              <img src='../images/Setting.svg' onclick = togglePopupUpdate_add('$Post_ID','C.Ads','$Publish_Date','$Publish_Time')>
                              <img src='../images/Close.svg' onclick = togglePopupremove_add('$Post_ID','C.Ads')>
                            </div>";
                              
                            echo "</div>
                            </div>";
                    }   
                }
              }
          ?>
         

          
    </div>

    

    </div>



<!--create popup window-->


<script>
  
  function togglePopupremove_add(Delete_ID,Type){
      $.ajax({
        url: "../Control/Pending_SetTime.php",
        type: "post",
        data: {Delete_ID:Delete_ID,
        Type:Type},
        success:function(data){
          console.log("correct");
          window.open('../view/Moderator_Set_Time.php','_self');
        }
      });
  }

  function togglePopupUpdate_add(Update_ID,Type,Date,Time){
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function(){
        document.getElementById("current_post_id").value = Update_ID;
        document.getElementById("current_post_type").value = Type;
        document.getElementById("update-date").value = Date;
        document.getElementById("update-time").value = Time;
      }
      xhttp.open("GET",Update_ID);
      xhttp.send();
      document.getElementById("popup-1").classList.toggle("active");
  }

  function toggle_view(View_ID,Type){
    $.ajax({
        url :"../Control/Pending_SetTime.php",
        type:"POST",
        data:{
          View_ID: View_ID,
          Type: Type
        },
        success:function(data){
          window.open('./Moderator_Set_Time_Read.php','_self');
        }
      });
  }
</script>


<div class="popup" id="popup-1">

      <div class="overlay"></div>

      <div class="content">
          <div class="close-btn" onclick="togglePopup()">&times;</div>


          <div class="content_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Update Publish Date & Time</h3>
                  
                  <form action="../Control/Pending_SetTime.php" method="post">

                     <input type="text" name="ID" id="current_post_id" style="display:none;">

                     <input type="text" name="Type" id="current_post_type" style="display:none;">

                     <label for="update-date" class="lbl">Date</label>
                  
                     <input type="date" name="update_set_time_date" id="update-date" class="inp" required>
                     <br>
                     <br>

                     <label for="update-time" class="lbl">Time</label>
                     
                     <input type="time" name="update_set_time_time" id="update-time" class="inp" required>
                     <br>
                     <br>

                     <button type="submit" name ="Update_Set_Time" class="update_btn" value="LOGIN">Update</button>
              
                   </form>

               </div>

          </div>
      </div>
      
</div>







<script>
    function showsort() {
      document.getElementById("sortdrop").classList.toggle("show");
    }

    function togglePopup(){
      document.getElementById("popup-1").classList.toggle("active");
    }


    function filterFunction() {
      var input, filter, ul, li, a, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      
      div_body = document.getElementById("content_sort");
      div_body_in = document.getElementsByClassName("box-container");
      abc = div_body.getElementsByTagName("abc");

      for (i = 0; i < abc.length; i++) {
        txtValue = abc[i].textContent || abc[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
              div_body_in[i].style.display = "";
            } else {
              div_body_in[i].style.display = "none";
        }
      }

  }


</script>
    
</body>
</html>