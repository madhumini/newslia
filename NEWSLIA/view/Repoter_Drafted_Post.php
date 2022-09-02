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
  <link rel="stylesheet" href="../css/moderator.css">
  <link rel="stylesheet" href="../css/search.css">
  <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico">
  <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
  <?php $page = 'more';
  include 'nav.php'; ?>
  <!--End of Navigation-Bar-->
  <!---->

  <div class="content_posts_view">
    <div class="posts_content_view_head" style="font-size: x-large;">
      Drafted Posts
    </div>
    
  </div>

  <div class="posts_content_view_body">
    <div class="body_information">
      <?php
      include '../Model/connect.php';

      $USERID = $_SESSION['System_Actor_ID'];

      //Print News

      $variable_1 = "SELECT *FROM news_drafted WHERE Creator_Id = '$USERID' ORDER BY Post_Id DESC";
      $variable_2 = $conn->query($variable_1);
      $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

      if ($variable_3) {
        foreach ($variable_3 as $variable_4) {

          $Post_ID = $variable_4['Post_Id'];
          $img = $variable_4['Image'];
          $img = base64_encode($img);
          $text = pathinfo($variable_4['Post_Id'], PATHINFO_EXTENSION);
          $Type = 'News';

          echo  "

              <div class='box-container' style='margin-bottom: 50px; margin-right: 40px; height: auto;'>
                  <div class='box_head' >
                    <img src='data:image/" . $text . ";base64," . $img . "' style='height: 170px;/>                  
                  </div>

                <div class='box_body' style='display: flex; justify-content: space-between;'>
                  <div style='display: flex; flex-direction: column; justify-content: space-around;''>
                    <h3> " . $Type . " </h3>  
                    <h4>" . $variable_4['Title'] . " </h4>
                    <p>" . $variable_4['Create_Date'] . "</p>
                  </div>

                  <div class='more' style='display: flex; margin-bottom: 10px; flex-direction: column;'>
                      <img src='../images/pen.svg'   onclick=toggle_edit('$Post_ID'); style=' padding-right: 5px; cursor: pointer; margin-top: 10px; height: 37px;'>
                      <i class='far fa-window-close fa-2x' style='color: red; cursor:pointer;'  onclick=togglePopup_Delete_Post_ID_News('$Post_ID','$Type');></i> 
                  </div>
                </div>
              </div> 
      
      
      


      

              <div class='navigation-popup  navigation-popup_set_time' id='confirm_delete_article'>
                <div class='navigation-overlay'></div>
                <div class='navigation-content  navigation-popup_set_time' style='width: 300px; height: 280px;'>
                  <div class='navigation-content_body  navigation-popup_set_time_body'>
                      <div class='navigation-popup_logo'>
                      <img src='../images/Name.svg'>
                      </div>
                    
                      <hr>

                      <div class='navigation-popup_form'>
                        <h3 class='navigation-popup_title' style='text-align: center;'>Sure to Delete</h3>
                          <div class='navigation-btn_set_option'>

                          <input id='store_delete_post_id' style = 'display:none;'> 
                          <input id='store_delete_post_type' style = 'display:none;'> 
          
                              <div class='navigation-select_option' onclick=toggle_delete(); style='text-align: center; font-weight: bold; background-color: #FF4444EB;'>Yes</div>
                              <div class='navigation-select_option' onclick=window.open('./Repoter_Drafted_Post.php','_self'); style='text-align: center; font-weight: bold;'>No</div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>            
      ";
        }
      }





      //Print commercial advertisements


      $variable_1 = "SELECT *FROM com_ads_drafted WHERE Creator_Id = '$USERID' ORDER BY Post_Id DESC";
      $variable_2 = $conn->query($variable_1);
      $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

      if ($variable_3) {
        foreach ($variable_3 as $variable_4) {

          $Post_ID = $variable_4['Post_Id'];
          $img = $variable_4['Image'];
          $img = base64_encode($img);
          $text = pathinfo($variable_4['Post_Id'], PATHINFO_EXTENSION);
          $Type = 'Commercial_Advertisement';

          echo  "


          <div class='box-container' style='margin-bottom: 50px; margin-right: 40px; height: auto;'>
              <div class='box_head' >
                <img src='data:image/" . $text . ";base64," . $img . "' style='height: 170px;/>                  
              </div>

            <div class='box_body' style='display: flex; justify-content: space-between;'>
              <div style='display: flex; flex-direction: column; justify-content: space-around;''>
              <h3> " . $Type . " </h3>  
              <h4>" . $variable_4['Title'] . " </h4>
                <p>" . $variable_4['Create_Date'] . "</p>

              </div>

              <div class='more' style='display: flex; margin-bottom: 10px; flex-direction: column;'>
                <img src='../images/pen.svg'   onclick=toggle_edit_CA('$Post_ID'); style=' padding-right: 5px; cursor: pointer; margin-top: 10px; height: 37px;'>
                  <i class='far fa-window-close fa-2x' style='color: red; cursor:pointer;'  onclick=togglePopup_Delete_Post_ID_CA('$Post_ID','$Type');></i> 
              </div>
            </div>
          </div> 
      
      
      


      

              <div class='navigation-popup  navigation-popup_set_time' id='confirm_delete_CA'>
                <div class='navigation-overlay'></div>
                <div class='navigation-content  navigation-popup_set_time' style='width: 300px; height: 280px;'>
                  <div class='navigation-content_body  navigation-popup_set_time_body'>
                      <div class='navigation-popup_logo'>
                      <img src='../images/Name.svg'>
                      </div>
                    
                    <hr>

                      <div class='navigation-popup_form'>
                        <h3 class='navigation-popup_title' style='text-align: center;'>Sure to Delete</h3>
                          <div class='navigation-btn_set_option'>

                               <input id='store_delete_post_id' style = 'display:none;'> 
                               <input id='store_delete_post_type' style = 'display:none;'> 
      
                    <div class='navigation-select_option' onclick=toggle_delete(); style='text-align: center; font-weight: bold; background-color: #FF4444EB;'>Yes</div>
                     <div class='navigation-select_option' onclick=window.open('./Repoter_Drafted_Post.php','_self'); style='text-align: center; font-weight: bold;'>No</div>

                          </div>
                      </div>
                  </div>
                </div>
              </div>            
      ";
        }
      }






      //Print job vacancy


      $variable_1 = "SELECT *FROM job_vacancies_drafted WHERE Creator_Id = '$USERID'  ORDER BY Post_Id DESC";
      $variable_2 = $conn->query($variable_1);
      $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

      if ($variable_3) {
        foreach ($variable_3 as $variable_4) {

          $Post_ID = $variable_4['Post_Id'];
          $img = $variable_4['Image'];
          $img = base64_encode($img);
          $text = pathinfo($variable_4['Post_Id'], PATHINFO_EXTENSION);
          $Type = 'Job_Vacancy';

          echo  "
            <div class='box-container' style='margin-bottom: 50px; margin-right: 40px; height: auto;'>
                <div class='box_head' >
                  <img src='data:image/" . $text . ";base64," . $img . "' style='height: 170px;/>                  
                </div>
  
              <div class='box_body' style='display: flex; justify-content: space-between;'>
                <div style='display: flex; flex-direction: column; justify-content: space-around;''>
                <h3> " . $Type . " </h3>  
                <h4>" . $variable_4['Company'] . " </h4>
                  <p>Create Date : " . $variable_4['Create_Date'] . "</p>
                  <p>Position : " . $variable_4['Position'] . "</p>

                </div>
  
                <div class='more' style='display: flex; margin-bottom: 10px; flex-direction: column;'>
                  <img src='../images/pen.svg'   onclick=toggle_edit_JV('$Post_ID'); style=' padding-right: 5px; cursor: pointer; margin-top: 10px; height: 37px;'>
                    <i class='far fa-window-close fa-2x' style='color: red; cursor:pointer;'  onclick=togglePopup_Delete_Post_ID_JV('$Post_ID','$Type');></i> 
                </div>
              </div>
            </div> 
            
            
            

              <div class='navigation-popup  navigation-popup_set_time' id='confirm_delete_JV'>
                <div class='navigation-overlay'></div>
                  <div class='navigation-content  navigation-popup_set_time' style='width: 300px; height: 280px;'>
                    <div class='navigation-content_body  navigation-popup_set_time_body'>
                      <div class='navigation-popup_logo'>
                      <img src='../images/Name.svg'>
                      </div>
                      
                      <hr>

                      <div class='navigation-popup_form'>
                        <h3 class='navigation-popup_title' style='text-align: center;'>Sure to Delete</h3>
                        <div class='navigation-btn_set_option'>

                        <input id='store_delete_post_id' style = 'display:none;'> 
                        <input id='store_delete_post_type' style = 'display:none;'> 
        
                          <div class='navigation-select_option' onclick=toggle_delete(); style='text-align: center; font-weight: bold; background-color: #FF4444EB;'>Yes</div>
                          <div class='navigation-select_option' onclick=window.open('./Repoter_Drafted_Post.php','_self'); style='text-align: center; font-weight: bold;'>No</div>

                        </div>
                      </div>
                    </div>
                  </div>
              </div>            
            ";
        }
      }






      //Print notice


      $variable_1 = "SELECT *FROM notices_drafted WHERE Creator_Id = '$USERID' ORDER BY Post_Id DESC";
      $variable_2 = $conn->query($variable_1);
      $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

      if ($variable_3) {
        foreach ($variable_3 as $variable_4) {

          $Post_ID = $variable_4['Post_Id'];
          $img = $variable_4['Image'];
          $img = base64_encode($img);
          $text = pathinfo($variable_4['Post_Id'], PATHINFO_EXTENSION);
          $Type = 'Notice';

          echo  "
            <div class='box-container' style='margin-bottom: 50px; margin-right: 40px; height: auto;'>
                <div class='box_head' >
                  <img src='data:image/" . $text . ";base64," . $img . "' style='height: 170px;/>                  
                </div>
  
              <div class='box_body' style='display: flex; justify-content: space-between;'>
                <div style='display: flex; flex-direction: column; justify-content: space-around;''>
                <h3> " . $Type . " </h3>  
                <h4>" . $variable_4['Title'] . " </h4>
                  <p>Create Date : " . $variable_4['Create_Date'] . "</p>
                </div>
  
                <div class='more' style='display: flex; margin-bottom: 10px; flex-direction: column;'>
                  <img src='../images/pen.svg'   onclick=toggle_edit_NO('$Post_ID'); style=' padding-right: 5px; cursor: pointer; margin-top: 10px; height: 37px;'>
                    <i class='far fa-window-close fa-2x' style='color: red; cursor:pointer;'  onclick=togglePopup_Delete_Post_ID_NO('$Post_ID','$Type');></i> 
                </div>
              </div>
            </div> 
            
            
            


            

          <div class='navigation-popup  navigation-popup_set_time' id='confirm_delete_NO'>
            <div class='navigation-overlay'></div>
              <div class='navigation-content  navigation-popup_set_time' style='width: 300px; height: 280px;'>
                <div class='navigation-content_body  navigation-popup_set_time_body'>
                  <div class='navigation-popup_logo'>
                  <img src='../images/Name.svg'>
                  </div>
                  
                  <hr>

                  <div class='navigation-popup_form'>
                    <h3 class='navigation-popup_title' style='text-align: center;'>Sure to Delete</h3>
                    <div class='navigation-btn_set_option'>

                    <input id='store_delete_post_id' style = 'display:none;'> 
                    <input id='store_delete_post_type' style = 'display:none;'> 
    
                      <div class='navigation-select_option' onclick=toggle_delete(); style='text-align: center; font-weight: bold; background-color: #FF4444EB;'>Yes</div>
                      <div class='navigation-select_option' onclick=window.open('./Repoter_Drafted_Post.php','_self'); style='text-align: center; font-weight: bold;'>No</div>

                    </div>
                  </div>
                </div>
              </div>
          </div>    
          
          
            ";
        }
      }





      ?>


    </div>
  </div>
</body>

<script>
  function showsort() {
    document.getElementById("sortdrop").classList.toggle("show");
  }

  function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("sortdrop");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }

  function toggle_edit(PENDING_POST_ID) {
    $.ajax({
      url: "../Control/N_User_Post_Handle.php",
      type: "POST",
      data: {
        PENDING_POST_ID: PENDING_POST_ID,
      },
      success: function(data) {
        window.open('./Repoter_Edit_Drafted_News.php', '_self');
      }
    });
  }

  function toggle_edit_CA(PENDING_POST_ID) {
    $.ajax({
      url: "../Control/N_User_Post_Handle.php",
      type: "POST",
      data: {
        PENDING_POST_ID: PENDING_POST_ID,
      },
      success: function(data) {
        window.open('./N_User_Edit_Drafted_Commercial_Ad.php', '_self');
      }
    });
  }

  function toggle_edit_JV(PENDING_POST_ID) {
    $.ajax({
      url: "../Control/N_User_Post_Handle.php",
      type: "POST",
      data: {
        PENDING_POST_ID: PENDING_POST_ID,
      },
      success: function(data) {
        window.open('./N_User_Edit_Drafted_Job_Vacancy.php', '_self');
      }
    });
  }

  function toggle_edit_NO(PENDING_POST_ID) {
    $.ajax({
      url: "../Control/N_User_Post_Handle.php",
      type: "POST",
      data: {
        PENDING_POST_ID: PENDING_POST_ID,
      },
      success: function(data) {
        window.open('./N_User_Edit_Drafted_Notice.php', '_self');
      }
    });
  }


    // delete post

    function toggle_delete() {
  var DELETE_POST_ID = document.getElementById("store_delete_post_id").value;
  var DELETE_POST_TYPE  = document.getElementById("store_delete_post_type").value;
    $.ajax({
      url: "../Control/N_User_Post_Handle.php",
      type: "POST",
      data: {
        DELETE_POST_ID: DELETE_POST_ID,
        DELETE_POST_TYPE: DELETE_POST_TYPE,
      },
      success: function(data) {
        window.open('./N_User_Delete_Drafted_Post.php', '_self');
      }
    });
  }

  function togglePopup_Delete_Post_ID_News(Post_Id, Post_Type){
    const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("store_delete_post_id").value = Post_Id;
          document.getElementById("store_delete_post_type").value = Post_Type;
      }
      xhttp.open("GET", Post_Id, Post_Type);
      xhttp.send(); 

      document.getElementById('confirm_delete_article').classList.toggle("active");
  }


  function togglePopup_Delete_Post_ID_CA(Post_Id, Post_Type){
    const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("store_delete_post_id").value = Post_Id;
          document.getElementById("store_delete_post_type").value = Post_Type;
      }
      xhttp.open("GET", Post_Id, Post_Type);
      xhttp.send(); 

      document.getElementById('confirm_delete_CA').classList.toggle("active");
  }


  function togglePopup_Delete_Post_ID_JV(Post_Id, Post_Type){
    const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("store_delete_post_id").value = Post_Id;
          document.getElementById("store_delete_post_type").value = Post_Type;
      }
      xhttp.open("GET", Post_Id, Post_Type);
      xhttp.send(); 

      document.getElementById('confirm_delete_JV').classList.toggle("active");
  }

  function togglePopup_Delete_Post_ID_NO(Post_Id, Post_Type){
    const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("store_delete_post_id").value = Post_Id;
          document.getElementById("store_delete_post_type").value = Post_Type;
      }
      xhttp.open("GET", Post_Id, Post_Type);
      xhttp.send(); 

      document.getElementById('confirm_delete_NO').classList.toggle("active");
  }
</script>


</html>