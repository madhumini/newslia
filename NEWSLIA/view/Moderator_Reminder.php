<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>NEWSLIA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
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

  .box-container {
    height: 290px;
    margin-left:-2.5rem;
  }

  

  .content_posts_view {
    display: flex;
    flex-direction: row;
    padding: 2vw 0vw 0vw 7vw;
    justify-content: space-between;
  }

  .posts_content_view_head{
      font-size:x-large;
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
  .box_head:hover img{
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

  .popup .content{
    height:260px;
  }


</style>

<body>
  
<!--navigation-->

<?php $page = 'more';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



  <!--End of Navigation-Bar-->

  <div class="content_posts_view">
    <div class="posts_content_view_head">
            Reminder Posts
    </div>
  </div>



  <div class="posts_content_view_body">

<div class="body_information">


<script>
  function togglePopupupdate_reminder(Reminder_Post_ID){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      document.getElementById("update_reminder_id").value = Reminder_Post_ID;
    }
    xhttp.open("GET",Reminder_Post_ID);
    xhttp.send(); 

    $.ajax({
      url :"../Control/save_hidden.php",
      type :"POST",
      cache :false,
      data:{Reminder_Post_ID : Reminder_Post_ID},
      success:function(data){
        var result = $.parseJSON(data);
        document.getElementById("update_date").value = result[0];
      }

    })


    document.getElementById("popup-1").classList.add("active");
  }


  function togglePopupremove_reminder(Reminder_Post_Delete_ID){

    $.ajax({
      url :"../Control/save_hidden.php",
      type :"POST",
      cache :false,
      data:{Reminder_Post_Delete_ID : Reminder_Post_Delete_ID},
      success:function(data){
        window.open("./Moderator_Reminder.php",'_self');
      }
    });

  }

</script>



<?php
    
    include '../Model/connect.php';
    $System_Actor_ID = $_SESSION['System_Actor_ID'];

    $reminder_sql = "SELECT * FROM reminder WHERE System_Actor_ID ='$System_Actor_ID' ORDER BY Post_ID DESC";

    $reminder_state = $conn->query($reminder_sql);
    $reminder_results = $reminder_state->fetchAll(PDO::FETCH_ASSOC);

    if($reminder_results){
      foreach($reminder_results as $reminder_result){

        $Post_ID = $reminder_result['Post_ID'];
        $Post_Type = $reminder_result['Post_Type'];
        $Reminder_Date = $reminder_result['Reminder_Date'];
        $table = "";

        if($Post_Type == "NEWS"){
          $table = 'NEWS';
          $reminder_info_sql = "SELECT * FROM news WHERE Post_ID='$Post_ID'";
        }
        else if($Post_Type == "ARTICLES"){
          $table = 'ARTICLES';
          $reminder_info_sql = "SELECT * FROM articles WHERE Post_ID='$Post_ID'";
        }
        else if($Post_Type == "NOTICES"){
          $table = 'NOTICES';
          $reminder_info_sql = "SELECT * FROM notices WHERE Post_ID='$Post_ID'";
        }
        else if($Post_Type == "VACANCIES"){
          $table = 'VACANCIES';
          $reminder_info_sql = "SELECT * FROM job_vacancies WHERE Post_ID='$Post_ID'";
        }
        else if($Post_Type == "C.ADS"){
          $table = 'C.ADS';
          $reminder_info_sql = "SELECT * FROM com_ads WHERE Post_ID='$Post_ID'";
        }

        $reminder_info_state = $conn->query($reminder_info_sql);
        $reminder_info_results = $reminder_info_state->fetchAll(PDO::FETCH_ASSOC);
        
        if($reminder_info_results){
            foreach($reminder_info_results as $reminder_info_result){

              $Post_ID = $reminder_info_result['Post_ID'];
              $Type = $table;
          
              $img = $reminder_info_result['Image'];
              $img = base64_encode($img);
              $text = pathinfo($reminder_info_result['Post_ID'], PATHINFO_EXTENSION);

              $TITLE = $reminder_info_result['Title'];
              $P_DATE = $reminder_info_result['Publish_Date'];
              $TITLE = $reminder_info_result['Title'];
              $Creator_ID = $reminder_info_result['Creator_ID'];
                

                echo "<div class='box-container'>
                <div class='box_head'>
                  <img src='data:image/".$text.";base64,".$img."'/>
                  
                  <div class='tag'>
                    <div class='tag_text'>".$table."</div>
                  </div>
                  
                  
                </div>
                
                <div class='box_body'>
                  <h3>".$TITLE."</h3>";
                  
                
                    echo "<p> Reminder Date: ".$Reminder_Date."</p>";
                  

              
                  $reminder_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                  $reminder_from_state = $conn->query($reminder_from_sql);
                  $reminder_from_results = $reminder_from_state->fetchAll(PDO::FETCH_ASSOC);

                  if($reminder_from_results){
                      echo "<b><i>-</b></i>";
                    foreach($reminder_from_results as $reminder_from_result){
                      echo "<i>".$reminder_from_result['Area']." - ";
                      echo "</i>";
                    }
                  }

                  echo "<br>";
                
                  $reminder_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                  $reminder_who_state = $conn->query($reminder_who_sql);
                  $reminder_who_results = $reminder_who_state->fetchAll(PDO::FETCH_ASSOC);

                  if($reminder_who_results){
                    foreach($reminder_who_results as $reminder_who_result){
                      echo "<p>".$reminder_who_result['FirstName']." ".$reminder_who_result['LastName']."</p>";    
                    }
                  }
        
                 echo "</div>";
                
                 echo "<div class='setting_close'>";
                 echo "<img src='../images/pen.svg' onclick=togglePopupupdate_reminder('$Post_ID');>";
                 echo "<img src='../images/close_large.svg' onclick = togglePopupremove_reminder('$Post_ID');>";
                 
                 echo "</div>";
                 echo "</div>";

            }
        }
      }
    }

?>

</div>

</div>







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
            <h3 class="popup_title">Update Reminder Date</h3>
            <form action="../Control/save_hidden.php" method="post">

               <label for="update-date" class="lbl">Date</label>
               
               <input type="text" name="reminder_id" id="update_reminder_id" class="inp" required style="display:none;">
               
               <input type="date" name="reminder_date" id="update_date" class="inp" required>
               <br>
               <br>

               <button type="submit" name ="Update_Reminder" class="update_btn" value="LOGIN">Update</button>
        
             </form>
         </div>

    </div>
</div>

</div>



</body>

<script>

function togglePopup(){
      document.getElementById("popup-1").classList.toggle("active");
    }


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
</script>

</html>