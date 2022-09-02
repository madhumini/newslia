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
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  .box_head:hover img{
    opacity: 1;
  } 
  .post_sort{
      padding-left:80px;
  }
  .box-container{
    height: 270px;
  }

  .more{
      font-size:14px;
      text-align:right;
      margin-top:-12%;
      display:flex;
      flex-direction:row;
      
  }
  .more p{
    margin-left:5%;
  }


  .setting_close{
    transform:scale(1.5);
    margin-left:78%;
    margin-top :-5%;
  }
  .setting_close img{
    padding-right:5px;
    cursor: pointer;
  }

  .box-container:hover{
    transform: scale(1.6);
  }

  .box-container{
    transform: scale(1.6);
    margin-top: 5rem;
    margin-left: 1.8rem;
  }

  .box_body h3{
      font-size:0.9rem;
  }

  .box_body p{
      font-size:0.65rem;
  }

  .box-read{
    width:800px;
    height:400px;
    margin-top:-1rem;
    overflow: hidden;
    overflow-y:scroll;
    margin-left:30rem;
  }

  .box-read h2{
    font-size:1.8rem;
    font-weight:normal;
    color:#222;
  }

  .box-read p{
    font-weight:normal;
    font-size:1rem;
    padding:1rem;
    text-align:justify;
    color:#555;
    letter-spacing:1.8px;
    line-height:30px;
  }

  .button-set{
    margin-top:-13rem;
    margin-left:5rem;
    display:flex;
    flex-direction:row;
  }

  .view_btn{
    width:100px;
    height:20px;
    margin-top:20%;
    margin-left:15rem;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.4);
    transition: 0.5s ease;
  }

  .view_btn:hover{
    transform:scale(1.2);
  }

  .update_btn{
    color:#222;
    margin-top:15rem;
    text-align:center;
  }

  .back_btn{
    margin-top:15.2rem;
    background-color:#ADD8E6;
    margin-left:40rem;
    color:#222;
  }

  .publish_btn{
    background-color: #ACE0B8;;
    color: #444;
    font-weight: 500;
    font-size: 16px;
    padding: 10px 20px;
    text-align: center;
    border-radius: 5px;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.25);
    cursor: pointer;
    width: 50px;
    margin-top: 20px;
    margin-left: 5rem;
  }


  .remove_btn{
   margin-top:15.2rem;
   background-color:#FF4444;
   margin-left:3rem;
   color:#222;
  }

  .close_btn{
    position: flex;
    margin-left:95%;
    margin-top:1%; 
    cursor: pointer;
  }
  .close_btn img{
    width:30px;
  }

  .popup_smart .popup_smart_content{
    width:290px;
    height: 260px;
  }

  .inp1{
    margin-left:-0.5rem;
  }


  .img_set{
      margin-top:15.5rem;
      transform: scale(1.4);
      padding-left:2rem;   
  }

  .img_set img{
    cursor: pointer;
  }

  .btn_set_option{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .select_option{
      background:#ACE0B8;
      margin-bottom:0.5rem;
      padding: 1rem;
      width:12.5rem;
      color:#444;
      font-weight:10px;
      letter-spacing:1px;
      transition: 0.5s ease;
      cursor: pointer;
  }

  .select_option:hover{
    transform:scale(1.1);
  }

  .posts_content_view_body{
  margin-top:3rem;
}

.view_btn ul{
    list-style-type: none;
  }

  .view_btn ul a{
    text-decoration:none;
    color:#333;
  }


  .popup .content{
    height: 270px;
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

</style>

<body>
 
<!--navigation-->

<?php $page = 'more';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!-- Moderator Notices View -->

<?php
    include '../Model/connect.php';

    $Post_ID = $_SESSION['READ_VIEW_Post_ID'];
    $Post_Type = $_SESSION['READ_VIEW_TYPE'];

    if($Post_Type == "NEWS"){
      $view_read_sql = "SELECT * FROM news WHERE Post_ID='$Post_ID'";
    }
    else if($Post_Type == "ARTICLES"){
      $view_read_sql = "SELECT * FROM articles WHERE Post_ID='$Post_ID'";
    }
    else if($Post_Type == "NOTICES"){
      $view_read_sql = "SELECT * FROM notices WHERE Post_ID='$Post_ID'";
    }
    else if($Post_Type == "VACANCIES"){
       $view_read_sql = "SELECT * FROM job_vacancies WHERE Post_ID='$Post_ID'";
    }
    else if($Post_Type == "C.ADS"){
       $view_read_sql = "SELECT * FROM com_ads WHERE Post_ID='$Post_ID'";
    }


    $view_read_state = $conn->query($view_read_sql);
    $view_read_results = $view_read_state->fetchAll(PDO::FETCH_ASSOC);

    if($view_read_results){
        foreach($view_read_results as $view_read_result){
            $_SESSION['Title'] = $view_read_result['Title'];
            
            if($Post_Type == "VACANCIES"){
              $_SESSION['PD_Date'] = $view_read_result['Deadline_Date'];
            }
            else{
              $_SESSION['PD_Date'] = $view_read_result['Publish_Date'];
            }

            $_SESSION['Img'] = $view_read_result['Image'];
            $_SESSION['Details'] = $view_read_result['Details'];
            $_SESSION['Creator_Id'] = $view_read_result['Creator_ID'];
        }
    }

    $Creator_ID = $_SESSION['Creator_Id'];
    $post_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
    $post_who_state = $conn->query($post_who_sql);
    $post_who_results = $post_who_state->fetchAll(PDO::FETCH_ASSOC);

    if($post_who_results){
        foreach($post_who_results as $post_who_result){
            $_SESSION['FirstName'] = $post_who_result['FirstName'];
            $_SESSION['LastName'] = $post_who_result['LastName'];    
        }
    }

    $img = $_SESSION['Img'];
    $img = base64_encode($img);
    $text = pathinfo($Post_ID, PATHINFO_EXTENSION);



?>



<?php

    $Post_Type = $_SESSION['READ_VIEW_TYPE'];
    $Post_ID = $_SESSION['READ_VIEW_Post_ID'];
    $USERID = $_SESSION['System_Actor_ID'];
    $count_vote = 0;
    $my_vote =0;

    if($Post_Type == "NEWS"){

        $sql_get_all_vote = "SELECT COUNT(Vote) AS COUNT_VOTE FROM vote WHERE Vote = '1' AND Post_ID = '$Post_ID'";
        $statement_get_all_vote = $conn->query($sql_get_all_vote);
        $results_get_all_vote = $statement_get_all_vote->fetchAll(PDO::FETCH_ASSOC);
        
        if($results_get_all_vote){
          foreach($results_get_all_vote as $result_get_all_vote){
              $count_vote = $result_get_all_vote['COUNT_VOTE'];
          }
        }

        $sql_get_my_vote = "SELECT Vote FROM vote WHERE System_Actor_ID = '$USERID'";
        $statement_get_my_vote = $conn->query($sql_get_my_vote);
        $results_get_my_vote = $statement_get_my_vote->fetchAll(PDO::FETCH_ASSOC);
        if($results_get_my_vote){
          foreach($results_get_my_vote as $result_get_my_vote){
              $my_vote = $result_get_my_vote['Vote'];
          }
        }


        echo "<div class='rate' style='text-align: center; width: 5%; background-color: #ACE0B8;border:1px solid #333;height:27rem;margin-left:2rem;margin-top:5rem;'>
        
        <div><a href='#' style='color: black;margin-top:5rem;'>";

            if($my_vote == 1){
              echo "<i class='fas fa-chevron-up fa-3x' style = 'color:blue;' onclick = update_up_my('$Post_ID','$USERID','1');></i></a>";
            }
            else{
              echo "<i class='fas fa-chevron-up fa-3x' onclick = update_up_my('$Post_ID','$USERID','1');></i></a>";
            }
              
        
        echo "</div>
              
              <h2 style='color: black;margin-top:8rem;'>".$count_vote."</h2>
        
        <div style='padding-top:8rem;'><a href='#' style='color: black;margin-top:15rem;'>";
              
              if($my_vote == -1){
                echo "<i class='fas fa-chevron-down fa-3x' style = 'color:blue;' onclick = update_up_my('$Post_ID','$USERID','-1');></i></a>";
              }
              else{
                echo "<i class='fas fa-chevron-down fa-3x' onclick = update_up_my('$Post_ID','$USERID','-1');></i></a> ";
              }

      echo "</div>
    </div>";
    }

?>

<script>
  function update_up_my(Post_ID,Voter_ID,Vote){
    $.ajax({
      url : "../Control/post_control.php",
      type :"POST",
      data :{Post_ID:Post_ID,
            Voter_ID:Voter_ID,
            Vote:Vote},
      success:function(data){
       window.open("./Moderator_View_Post_Read.php","_self");
      }
    })
  }

</script>

<div class="posts_content_view_body">

    <?php

      $Post_Type = $_SESSION['READ_VIEW_TYPE'];

      if($Post_Type == "NEWS"){
            echo "<div class='body_information' style='margin-top:-32.5rem;margin-left:1rem;'>";
      }
      else{
            echo "<div class='body_information' style='margin-top:1rem;margin-left:1rem;'>";
      }
    ?>
          <div class="box-container">

              <div class="box_head">
                  <?php echo "<img src='data:image/".$text.";base64,".$img."'/>";?>
              </div>

              <div class="box_body">
                
                <h3><?php echo $_SESSION['Title']; ?></h3>
                <p><?php echo $_SESSION['PD_Date']; ?></p>

                <?php
                    $Post_ID = $_SESSION['READ_VIEW_Post_ID'];
                    $view_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                    $view_from_state = $conn->query($view_from_sql);
                    $view_from_results = $view_from_state->fetchAll(PDO::FETCH_ASSOC);

                    if($view_from_results){
                        echo "<h6><b><i>-</b></i>";
                        foreach($view_from_results as $view_from_result){
                           echo "<i>".$view_from_result['Area']." - ";
                           echo "</i>";
                         }
                         echo "</h6>";
                     }
                ?>

                <p><?php echo $_SESSION['FirstName']; echo " "; echo $_SESSION['LastName']; ?></p>
              </div>

            <div class="more" style="width: 14%; margin-bottom: 20px;">
            <img src="../images/More.svg" alt="" srcset="" style="transform: none;margin-top:0rem;width:7px;margin-left:2rem;">
            <ul class="more_post" style="margin-top:0rem;margin-left:2.5rem;">

            <?php
               $Post_ID = $_SESSION['READ_VIEW_Post_ID'];
               $Post_Type = $_SESSION['READ_VIEW_TYPE'];
              echo "<li onclick=toggle_save('$Post_ID','$Post_Type');><a href='#' >Save</a></li>
                    <li onclick=toggle_hidden('$Post_ID','$Post_Type');><a href='#'>Hide</a></li>
                    <li onclick=toggle_reminder('$Post_ID','$Post_Type');><a href='#'>Reminder</a></li>";
            ?>
              
            </ul>
          </div>

          </div>

          <div class="box-read" style="margin-top:-2rem;margin-left:1rem;">
             <h2><?php echo $_SESSION['Title']; ?></h2>
             <p><?php echo $_SESSION['Details']; ?></p>
          </div>
    </div>

    <div class="button-set">
        <?php
            echo "<div class='view_btn back_btn' onclick='window.open('./Moderator_Save.php', '_self')'>
                    <ul>
                      <li onclick=toggle_back('$Post_Type');><a href='#'>Back</a></li>
                    </ul>
                  </div>";  
        ?>
    </div>
</div>


<div class="popup popup_set_time" id="popup-8">

      <div class="overlay"></div>

      <div class="content popup_set_time">
          <div class="close-btn" onclick="set_time_to_publish_Popup()">&times;</div>


          <div class="content_body popup_set_time_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Set Time to Reminder</h3>
                  <form action="../Control/save_hidden.php" method="post">

                  
                    <label for="new-date" class="lbl"> Date</label>
                    <input type="text" name="add_reminder_id" id="reminder_ID" class="inp inp1" style="display:none;">
                    <input type="text" name="add_reminder_type" id="reminder_Type" class="inp inp1" style="display:none;">
                    <input type="date" name="add_reminder_date" id="new-date" class="inp inp1">
                      <br>
                      <br>
  
                    <button type="submit" name ="Add_Reminder" class="update_btn" value="LOGIN">Set</button>
                    
              
                   </form>
               </div>

          </div>
      </div>
      
</div>




<script>

    function set_time_to_publish_Popup(){
      document.getElementById("popup-8").classList.toggle("active");
    } 

    function toggle_reminder(Reminder_post_ID,Type){

      const xhttp = new XMLHttpRequest();
      xhttp.onload = function(){
        document.getElementById("reminder_ID").value = Reminder_post_ID;
        document.getElementById("reminder_Type").value = Type;
      }
      xhttp.open("GET",Reminder_post_ID,Type);
      xhttp.send(); 
      document.getElementById("popup-8").classList.add("active");

    }


    function toggle_back(Type){
      if(Type == "NOTICES"){
        window.open('./Moderator_View_Notices.php','_self');
      }
      else if(Type == "C.ADS"){
        window.open('./Moderator_View_Ads.php','_self');
      }
      else if(Type == "VACANCIES"){
        window.open('./Moderator_View_Jobs.php','_self');
      }
      else if(Type == "ARTICLES"){
        window.open('./Moderator_View_Articles.php','_self');
      }
      else if(Type == "NEWS"){
        window.open('./Moderator_View_News.php','_self');
      }
      
    }

    function toggle_save(save_post_id,Type){
      $.ajax({
        url : '../Control/post_control.php',
        type: "POST",
        data :{save_post_id:save_post_id,
          Type:Type},
        success:function(data){
          window.open("./Moderator_View_Post_Read.php","_self");
        }
      })

    }

    function toggle_hidden(hidden_post_id,Type){
      $.ajax({
        url : "../Control/post_control.php",
        type :"POST",
        data :{hidden_post_id:hidden_post_id,
          Type:Type},
        success:function(){
            toggle_back(Type);
        }
      })
    }
</script>











</body>
</html>