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
    height: 250px;
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
    margin-left:3rem;
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

  .back_btn{
    margin-top:15.2rem;
    background-color:#ADD8E6;
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

  .update_btn{
    text-align:center;
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
</style>

<body>
 


<!--navigation-->

<?php $page = 'view';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<?php
    include '../Model/connect.php';

    $Post_ID = $_SESSION['SMART_CAL'];

    $view_read_sql = "SELECT * FROM news WHERE Post_ID='$Post_ID'";

    $view_read_state = $conn->query($view_read_sql);
    $view_read_results = $view_read_state->fetchAll(PDO::FETCH_ASSOC);

    if($view_read_results){
      foreach($view_read_results as $view_read_result){
        
        $_SESSION['Title'] = $view_read_result['Title'];
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


<!-- Moderator Notices View -->

<div class="posts_content_view_body">

    <div class="body_information">
         
          <div class="box-container">

              <div class="box_head">
                <?php echo "<img src='data:image/".$text.";base64,".$img."'/>";?>
              </div>

              <div class="box_body">
                <h3><?php echo $_SESSION['Title']; ?></h3>
                

                <?php
                    $Post_ID = $_SESSION['SMART_CAL'];
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

              

          </div>



          <div class="box-read">

             <h2><?php echo $_SESSION['Title']; ?></h2>
             <p><?php echo $_SESSION['Details']; ?></p>
             
          </div>
    </div>

    <div class="button-set">

        <?php

        if($_SESSION['Actor_Type'] != "NORMALUSER" || $_SESSION['Actor_Type'] != "REPORTER"){?>
            <div class="view_btn update_btn" onclick="togglePopup()">Update</div>
            
            <form action="../Control/save_hidden.php" method="post">
               <button class="view_btn remove_btn" name = "REMOVE_SMART">Remove</button>
            </form>

        <?php }
        ?>
        <div class="view_btn back_btn" onclick="window.open('./Moderator_View_News.php', '_self')">Back</div>
    </div>
    
</div>








<!--create popup window-->


<div class="popup popup_smart" id="popup-3">

      <div class="overlay"></div>

      <div class="content popup_smart_content">
          <div class="close-btn" onclick="togglePopup()">&times;</div>


          <div class="content_body popup_smart_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Update Smart Calendar</h3>
                  <form action="../Control/save_hidden.php" method="post">

                     <label for="new-date" class="lbl"> Date</label>
                     <input type="hidden" name="smart_id" value="<?= $_SESSION['SMART_CAL']?>">
                     <input type="date" name="smart_update" id="new-date" class="inp inp1" required>
                     <br>

                     <button class="publish_btn" name="update_smart_calandar">Publish</button>
              
                   </form>
               </div>

          </div>
      </div>
      
</div>







<script>


    function togglePopup(){
      document.getElementById("popup-3").classList.toggle("active");
    }


   

</script>




</body>
</html>