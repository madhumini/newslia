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
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
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
            Hidden Posts
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

        $hidden_sql = "SELECT * FROM hidden WHERE System_Actor_ID='$System_Actor_ID' ORDER BY Post_ID DESC";

        $hidden_state = $conn->query($hidden_sql);
        $hidden_results = $hidden_state->fetchAll(PDO::FETCH_ASSOC);

        if($hidden_results){
          foreach($hidden_results as $hidden_result){

            $Post_ID = $hidden_result['Post_ID'];
            $Post_Type = $hidden_result['Post Type'];
            $table = "";

            if($Post_Type == "NEWS"){
              $table = 'NEWS';
              $hidden_info_sql = "SELECT * FROM news WHERE Post_ID='$Post_ID'";
            }
            else if($Post_Type == "ARTICLES"){
              $table = 'ARTICLES';
              $hidden_info_sql = "SELECT * FROM articles WHERE Post_ID='$Post_ID'";
            }
            else if($Post_Type == "NOTICES"){
              $table = 'NOTICES';
              $hidden_info_sql = "SELECT * FROM notices WHERE Post_ID='$Post_ID'";
            }
            else if($Post_Type == "VACANCIES"){
              $table = 'VACANCIES';
              $hidden_info_sql = "SELECT * FROM job_vacancies WHERE Post_ID='$Post_ID'";
            }
            else if($Post_Type == "C.ADS"){
              $table = 'C.ADS';
              $hidden_info_sql = "SELECT * FROM com_ads WHERE Post_ID='$Post_ID'";
            }

            $hidden_info_state = $conn->query($hidden_info_sql);
            $hidden_info_results = $hidden_info_state->fetchAll(PDO::FETCH_ASSOC);
            
            if($hidden_info_results){
                foreach($hidden_info_results as $hidden_info_result){

                  $Post_ID = $hidden_info_result['Post_ID'];
                  $Type = $table;
              
                  $img = $hidden_info_result['Image'];
                  $img = base64_encode($img);
                  $text = pathinfo($hidden_info_result['Post_ID'], PATHINFO_EXTENSION);

                  $TITLE = $hidden_info_result['Title'];
                  $P_DATE = $hidden_info_result['Publish_Date'];
                  $TITLE = $hidden_info_result['Title'];
                  $Creator_ID = $hidden_info_result['Creator_ID'];
                    

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
                        echo "<p>".$hidden_info_result['Deadline_Date']."</p>";
                      }
                      else{
                        echo "<p>".$P_DATE."</p>";
                      }

                  
                      $hidden_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                      $hidden_from_state = $conn->query($hidden_from_sql);
                      $hidden_from_results = $hidden_from_state->fetchAll(PDO::FETCH_ASSOC);

                      if($hidden_from_results){
                          echo "<b><i>-</b></i>";
                        foreach($hidden_from_results as $hidden_from_result){
                          echo "<i>".$hidden_from_result['Area']." - ";
                          echo "</i>";
                        }
                      }

                      echo "<br>";
                    
                      $hidden_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                      $hidden_who_state = $conn->query($hidden_who_sql);
                      $hidden_who_results = $hidden_who_state->fetchAll(PDO::FETCH_ASSOC);

                      if($hidden_who_results){
                        foreach($hidden_who_results as $hidden_who_result){
                          echo "<p>".$hidden_who_result['FirstName']." ".$hidden_who_result['LastName']."</p>";    
                        }
                      }
            
                     echo "
                    </div>
                    
                    <div style='margin-top: -75px; margin-left: 260px;cursor:pointer;'>
                        <p onclick=toggle_remove_hidden('$Post_ID');>
                          <img src='../images/Close.svg' style='transform:scale(2);'>
                        </p>
                    </div>
                 
                    </div>";

                }
            }
          }
        }
    
    ?>

  </div>

</div>

</body>

<script>
  
  function toggle_remove_hidden(HIDDEN_ID){
      $.ajax({
        url :"../Control/save_hidden.php",
        type:"POST",
        data:{
          REMOVE_HIDDEN_ID: HIDDEN_ID
        },
        success:function(data){
          window.open('./Moderator_Hidden.php','_self');
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
          window.open('./Moderator_Hidden_Read.php','_self');
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

  }

</script>

</html>