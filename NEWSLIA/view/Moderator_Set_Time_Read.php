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
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow: hidden; /* Hide scrollbars */
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
    margin-top:-17rem;
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
    margin-top:1rem;
    text-align:center;
    border: none;
    width:4rem;
    transition: 0.25s ease;
    box-shadow: none;
  }

  .update_btn:hover{
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.25);
    transform:scale(1.1);
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

.Update_Set_Time{
  margin-top:-5rem;
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

    $Post_ID = $_SESSION['SET_TIME_READ_Post_ID'];
    $Post_Type = $_SESSION['SET_TIME_READ_TYPE'];

    if($Post_Type == "Notices"){
      $settime_read_sql = "SELECT * FROM notices WHERE Post_ID='$Post_ID'";
    }
    else if($Post_Type == "Vacancies"){
       $settime_read_sql = "SELECT * FROM job_vacancies WHERE Post_ID='$Post_ID'";
    }
    else{
       $settime_read_sql = "SELECT * FROM com_ads WHERE Post_ID='$Post_ID'";
    }

    $settime_read_state = $conn->query($settime_read_sql);
    $settime_read_results = $settime_read_state->fetchAll(PDO::FETCH_ASSOC);

    if($settime_read_results){
        foreach($settime_read_results as $settime_read_result){
            $_SESSION['Title'] = $settime_read_result['Title'];
            
            if($Post_Type == "VACANCIES"){
              $_SESSION['PD_Date'] = $settime_read_result['Deadline_Date'];
              $_SESSION['Company'] = $settime_read_result['Company'];
            }
            else{
              $_SESSION['PD_Date'] = $settime_read_result['Publish_Date'];
            }

            $_SESSION['Img'] = $settime_read_result['Image'];
            $_SESSION['Details'] = $settime_read_result['Details'];
            $_SESSION['Creator_Id'] = $settime_read_result['Creator_ID'];
            $_SESSION['Set_Date'] = $settime_read_result['Set_Date'];
            $_SESSION['Set_Time'] = $settime_read_result['Set_Time'];
        }
    }

    $Creator_ID = $_SESSION['Creator_Id'];
    $set_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
    $set_who_state = $conn->query($set_who_sql);
    $set_who_results = $set_who_state->fetchAll(PDO::FETCH_ASSOC);

    if($set_who_results){
        foreach($set_who_results as $set_who_result){
            $_SESSION['FirstName'] = $set_who_result['FirstName'];
            $_SESSION['LastName'] = $set_who_result['LastName'];    
        }
    }

    $img = $_SESSION['Img'];
    $img = base64_encode($img);
    $text = pathinfo($Post_ID, PATHINFO_EXTENSION);



?>


<div class="posts_content_view_body">

    <div class="box-container">

        <div class="box_head">
           <?php echo "<img src='data:image/".$text.";base64,".$img."'/>";?>
        </div>

        <div class="box_body">
          <h3><?php echo $_SESSION['Title']; ?></h3>
          

        <?php
            $Post_ID = $_SESSION['SET_TIME_READ_Post_ID'];
            $set_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $set_from_state = $conn->query($set_from_sql);
            $set_from_results = $set_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($set_from_results){
                echo "<h6><b><i>-</b></i>";
                foreach($set_from_results as $set_from_result){
                   echo "<i>".$set_from_result['Area']." - ";
                   echo "</i>";
                  }
                echo "</h6>";
            }
        ?>

        <p><?php echo $_SESSION['FirstName']; echo " "; echo $_SESSION['LastName']; ?></p>
        <p><?php echo $_SESSION['Set_Date']; echo " "; echo $_SESSION['Set_Time'];  ?></p>
        </div>

            <div class="more" style="width: 14%; margin-bottom: 20px;">
            
            <?php
               $Post_ID = $_SESSION['SET_TIME_READ_Post_ID'];
               $Date = $_SESSION['Set_Date'];
               $Time = $_SESSION['Set_Time'];
               
               echo "<p onclick = togglePopup();>
                         <img src='../images/Setting.svg' style='transform:scale(3);margin-top:-2rem;width:7px;'>
                     </p>

                     <p onclick = togglePopupremove_add('$Post_ID','$Post_Type');>
                         <img src='../images/Close.svg' style='transform:scale(3);margin-top:-2rem;width:7px;margin-left:1rem;'>
                     </p>";
            ?>
            
          </div>

          </div>

          <div class="box-read" style="margin-top:0rem;margin-left:2rem;">
             <h2><?php echo $_SESSION['Title']; ?></h2>
             <p><?php echo $_SESSION['Details']; ?></p>
          </div>
    </div>

    <div class="button-set">
        <div class="view_btn back_btn" onclick="window.open('./Moderator_Set_Time.php', '_self')">Back</div>
    </div>
</div>


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

  function togglePopup(){
      document.getElementById("popup-1").classList.toggle("active");
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

                        <input type="text" name="ID" id="current_post_id" style="display:none;" value = <?php echo $Post_ID;?>>

                        <input type="text" name="Type" id="current_post_type" style="display:none;" value = <?php echo $Post_Type;?>>

                        <label for="update-date" class="lbl">Date</label>
                      
                        <input type="date" name="update_set_time_date" id="update-date" class="inp" required value = <?php echo $Date;?>>
                        <br>
                        <br>

                        <label for="update-time" class="lbl">Time</label>
                        
                        <input type="time" name="update_set_time_time" id="update-time" class="inp" required value = <?php echo $Time;?>>

                        <button type="submit" name ="Update_Set_Time_Read" class="update_btn" value="LOGIN">Update</button>
              
                   </form>

               </div>

          </div>
      </div>
      
</div>




</body>
</html>