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
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  
.box-container{
    height: 290px;
    margin-left:1rem;
  }

  .box_head img{
    height:50%;
  }
  .setting_close{
    transform:scale(1.2);
    margin-left:78%;
    margin-top :-12%;
  }
  .setting_close img{
    padding-right:5px;
    cursor: pointer;
  }

  .posts_content_view_head{
    font-size:x-large;

    }

   .posts_content_view_body{
       margin-left:7rem;
       margin-top:2rem;
       padding: 1.2vw;       
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

<?php $page = 'more';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->
 



<div class="content_posts_view">
    <div class="posts_content_view_head">
            Saved Posts
    </div>

      <div class="post_sort" style="margin-left:2rem;">
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

    <div class="body_information" id = "content_sort">
         
        <?php
        
            include '../Model/connect.php';
            $System_Actor_ID = $_SESSION['System_Actor_ID'];

            $save_sql = "SELECT * FROM save WHERE System_Actor_ID='$System_Actor_ID' ORDER BY Post_ID DESC";

            $save_state = $conn->query($save_sql);
            $save_results = $save_state->fetchAll(PDO::FETCH_ASSOC);

            if($save_results){
              foreach($save_results as $save_result){

                $Post_ID = $save_result['Post_ID'];
                $Post_Type = $save_result['Post Type'];
                $table = "";

                if($Post_Type == "NEWS"){
                  $table = 'NEWS';
                  $save_info_sql = "SELECT * FROM news WHERE Post_ID='$Post_ID'";
                }
                else if($Post_Type == "ARTICLES"){
                  $table = 'ARTICLES';
                  $save_info_sql = "SELECT * FROM articles WHERE Post_ID='$Post_ID'";
                }
                else if($Post_Type == "NOTICES"){
                  $table = 'NOTICES';
                  $save_info_sql = "SELECT * FROM notices WHERE Post_ID='$Post_ID'";
                }
                else if($Post_Type == "VACANCIES"){
                  $table = 'VACANCIES';
                  $save_info_sql = "SELECT * FROM job_vacancies WHERE Post_ID='$Post_ID'";
                }
                else if($Post_Type == "C.ADS"){
                  $table = 'C.ADS';
                  $save_info_sql = "SELECT * FROM com_ads WHERE Post_ID='$Post_ID'";
                }

                $save_info_state = $conn->query($save_info_sql);
                $save_info_results = $save_info_state->fetchAll(PDO::FETCH_ASSOC);
                
                if($save_info_results){
                    foreach($save_info_results as $save_info_result){

                      $Post_ID = $save_info_result['Post_ID'];
                      $Type = $table;
                  
                      $img = $save_info_result['Image'];
                      $img = base64_encode($img);
                      $text = pathinfo($save_info_result['Post_ID'], PATHINFO_EXTENSION);

                      $TITLE = $save_info_result['Title'];
                      $P_DATE = $save_info_result['Publish_Date'];
                      $TITLE = $save_info_result['Title'];
                      $Creator_ID = $save_info_result['Creator_ID'];
                        

                        echo "<div class='box-container'>
                        <div class='box_head'>
                          <img src='data:image/".$text.";base64,".$img."'/>
                          
                          <div class='tag'>
                            <div class='tag_text'><abc>".$table."</abc></div>
                          </div>
                          
                          <div class='middle'>
                               <div class='view_btn'>
                                   <ul>
                                      <li onclick=toggle_view('$Post_ID','$Type');><a href='#'>View</a></li>
                                   </ul>
                                          
                               </div>
                               
                          </div>
                        </div>
                        
                        <div class='box_body'>
                          <h3>".$TITLE."</h3>";
                          
                          if ($Type=="VACANCIES"){
                            echo "<p>".$save_info_result['Deadline_Date']."</p>";
                          }
                          else{
                            echo "<p>".$P_DATE."</p>";
                          }

                          

                          


                          $save_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                          $save_from_state = $conn->query($save_from_sql);
                          $save_from_results = $save_from_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_from_results){
                              echo "<b><i>-</b></i>";
                            foreach($save_from_results as $save_from_result){
                              echo "<i>".$save_from_result['Area']." - ";
                              echo "</i>";
                            }
                          }

                          echo "<br>";
                        
                          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $save_who_state = $conn->query($save_who_sql);
                          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_who_results){
                            foreach($save_who_results as $save_who_result){
                              echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                            }
                          }
                
                         echo "
                        </div>
                        <div class='more'>
                          <img src='../images/More.svg'>
                          <ul class ='more_post'>
                            <li onclick=toggle_unsave('$Post_ID');><a href='#' >Unsave</a></li>
                            <li onclick=toggle_hidden('$Post_ID','$Type');><a href='#'>Hide</a></li>
                          </ul>
                        </div>
                      </div>";

                    }
                }
              }
            }
        
        ?>
          
    </div>
</div>

<script>

    function toggle_unsave(SAVE_ID){
      $.ajax({
        url :"../Control/save_hidden.php",
        type:"POST",
        cache:false,
        data:{SAVE_ID:SAVE_ID},
        success:function(data){
          window.open('./Moderator_save.php','_self');
        }

      });
    }

    function toggle_hidden(HIDDEN_ID,TYPE){
      $.ajax({
        url :"../Control/save_hidden.php",
        type:"POST",
        data:{
          HIDDEN_ID: HIDDEN_ID,
          TYPE: TYPE
        },
        success:function(data){
          window.open('./Moderator_save.php','_self');
        }
      });
    }


    function toggle_view(VIEW_ID,TYPE){
      $.ajax({
        url :"../Control/save_hidden.php",
        type:"POST",
        data:{
          VIEW_ID: VIEW_ID,
          TYPE: TYPE
        },
        success:function(data){
          window.open('./Moderator_Read_save.php','_self');
        }
      });
    }
            
    function showsort() {
      document.getElementById("sortdrop").classList.toggle("show");
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


      console.log(i); 


    }


</script>
    
</body>
</html>