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
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
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
    height: 230px;
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


  @media only screen and (max-width: 715px) {
  
  .box_body h3{
    font-size:0.7rem;
  }

  .box_body p{
      font-size:0.45rem;
  }

  .more{
      font-size:12px;
    }

    .box-container{
      height: 200px;
      }
  }

  @media only screen and (max-width: 626px) {

    .box-container{
      width: 40%;
      height: 180px;
      }

      .more{
      font-size:10px;
    }

  }

  @media only screen and (max-width: 560px) {

    .box-container{
      width: 50%;
      height: 180px;
    }

     .button-set{
       display:none;
     }
     .button-set2{
      display: block;
    }
  
  }




  .box-read{
    height:400px;
    overflow: hidden;
    overflow-y:scroll;
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
    /*margin-left:3rem;*/
    display:flex;
    flex-direction:row;
    float: right;
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

.button-set{
  
}

.button-set2{
  display:none;
    margin-top:-10rem;
    text-align:center;
  }

  .button-set2 .view_btn{
    margin-left:5rem;
    margin-bottom:-13rem;
  }
</style>

<body>
 

<!--navigation-->

<?php $page = 'publish';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->

<!-- Moderator Notices View -->

<?php

      include '../Model/connect.php';

      $Post_ID = $_SESSION['SAVE_READ_Post_News_ID'];
      
      $Post = [
        'Post_ID' => $Post_ID,
        'Reporter_Can_Edit' => '0'
      ];
      
      $sql = 'UPDATE news_pending
              SET Reporter_Can_Edit = :Reporter_Can_Edit
              WHERE Post_ID = :Post_ID';
      
      $statement = $conn->prepare($sql);
      
      $statement->bindParam(':Post_ID', $Post['Post_ID']);
      $statement->bindParam(':Reporter_Can_Edit', $Post['Reporter_Can_Edit']);
      
      $statement->execute();

      $pending_read_sql = "SELECT * FROM news_pending WHERE Post_ID='$Post_ID'";
      $pending_read_statement = $conn->query($pending_read_sql);
      $pending_read_results = $pending_read_statement->fetchAll(PDO::FETCH_ASSOC);

      if($pending_read_results){
        foreach($pending_read_results as $pending_read_result){
          
          $img_X = $pending_read_result['Image'];
          $img = base64_encode($img_X);
          $text = pathinfo($pending_read_result['Post_ID'], PATHINFO_EXTENSION);

          $Creator_ID = $pending_read_result['Creator_ID'];
          $Title = $pending_read_result['Title'];
          $msg = $pending_read_result['Details'];
          $Smart = $pending_read_result['Calendar_Date'];	 
          $News_Category = $pending_read_result['News_Category'];	 
          
          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
          $save_who_state = $conn->query($save_who_sql);
          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

          if($save_who_results){
              foreach($save_who_results as $save_who_result){
                $First = $save_who_result['FirstName'];
                $Last = $save_who_result['LastName'];   
              }
          }

        }
      }

      echo "<div class='posts_content_view_body'>

          <div class='body_information'>
              
                <div class='box-container'>

                    <div class='box_head'>
                       <img src='data:image/".$text.";base64,".$img."'/>
                    </div>

                    <div class='box_body'>
                      <h3>".$Title."</h3>
                      <p>".$First." ".$Last."</p>
                    </div>

                    <div class='more'>
                          <p>".$Smart."</p>
                    </div>

                </div>

                <div class='box-read'>
                  <h2>".$Title."</h2>
                  <p>".$msg."</p>
                </div>
          </div>";
?>
        
        
        <div class='button-set'>
              <div class='view_btn update_btn' onclick='togglePopup_select_option()'>Accept</div>
              <form action="" method="post">
                  <button class="view_btn remove_btn" name = "Reject" style = "border:none;">Reject</button>
              </form>
              
              <div class="view_btn back_btn" onclick="window.open('./Moderator_Pending.php', '_self')">Back</div>
        </div>


        <div class='button-set2'>
              <div class='view_btn update_btn' onclick='togglePopup_select_option()'>Accept</div>
              <form action="" method="post">
                  <button class="view_btn remove_btn" name = "Reject" style = "border:none;">Reject</button>
              </form>
            
              <div class="view_btn back_btn" onclick="window.open('./Moderator_Pending.php', '_self')">Back</div>
        </div>
          
      </div>


<?php

    $Computer_Date = date("Y-m-d");
    $Computer_Time = date("H:i:s");
    $System_Actor_ID = $_SESSION['System_Actor_ID'];

    if(isset($_POST['Reject'])){
      
      // Notification
      $notification = $conn->prepare("INSERT INTO `notification`(`Post_ID`,`Approve_or_Reject`,`System_Actor_ID`,`Date`,`Time`,`Moderator_ID`,`Title`) VALUES(?,?,?,?,?,?,?)");
      $notification->execute([$Post_ID,'Reject',$Creator_ID,$Computer_Date,$Computer_Time,$System_Actor_ID,$Title]);
      
      $sql = 'DELETE FROM news_pending
        WHERE Post_ID = :Post_ID';

      // prepare the statement for execution
      $statement = $conn->prepare($sql);
      $statement->bindParam(':Post_ID', $Post_ID);

      // execute the statement  
      if($statement->execute()){

        $sql_Area = 'DELETE FROM post_area
        WHERE Post_ID = :Post_ID';

        // prepare the statement for execution
        $statement_Area = $conn->prepare($sql_Area);
        $statement_Area->bindParam(':Post_ID', $Post_ID);

        // execute the statement  
        if($statement_Area->execute()){
          echo $statement_Area->rowCount();
        }
        echo "<script>window.open('Moderator_Pending.php','_self')</script>";
      } 
    }


?>





<div class="popup popup_set_time" id="popup-6">

      <div class="overlay"></div>

      <div class="content popup_set_time">
          <div class="close-btn" onclick="togglePopup_select_option()">&times;</div>


          <div class="content_body popup_set_time_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Select Option to Publish</h3>
                  <div class="btn_set_option">
                          <div class="select_option" onclick="add_smart_calendar_Popup()">Add into the Calendar</div>
                          <div class="select_option" onclick="select_mode_Popup()">Publish Now</div>  
                  </div>
                  

               </div>

          </div>
      </div>
      
</div>



<div class="popup popup_smart" id="popup-7">

      <div class="overlay"></div>

      <div class="content popup_smart_content">
          <div class="close-btn" onclick="add_smart_calendar_Popup()">&times;</div>


          <div class="content_body popup_smart_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Add Smart Calendar</h3>
                  <form action="" method="post">

                     <label for="new-date" class="lbl"> Date</label>
                  
                     <input type="date" name="Smart_Date" id="new-date" class="inp inp1" value="<?php echo $Smart; ?>">
                     <br>

                     <div class="publish_btn" onclick="select_mode_Popup()">Publish</div>
              
                   
               </div>

          </div>
      </div>
      
</div>


<div class="popup popup_set_time" id="popup-8">

      <div class="overlay"></div>

      <div class="content popup_set_time">
          <div class="close-btn" onclick="remove_mode_Popup()">&times;</div>


          <div class="content_body popup_set_time_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Select Publish Mode</h3>
                  <div class="btn_set_option">
                      
                      
                          <div class="select_option" onclick="auto_mode_Popup()">Auto Delete Mode</div>
                          <button class="select_option" style="border:none;font-size:15px;" name="Normal">Normal Mode</button>  
                  </div>
                  

               </div>

          </div>
      </div>
      
</div>


<div class="popup popup_smart" id="popup-9">

      <div class="overlay"></div>

      <div class="content popup_smart_content" style="height:290px;">
          <div class="close-btn" onclick="auto_mode_Popup()">&times;</div>


          <div class="content_body popup_smart_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Select Auto Delete Date</h3>
                  

                     <label for="new-date" class="lbl"> Date</label>
                  
                     <input type="date" name="Auto_Date" id="new-date" class="inp inp1">
                     <br>
                     <br>
                     <label for="new-time" class="lbl"> Time</label>
                  
                    <input type="time" name="Auto_time" id="" class="inp inp1">
                    

                     <button class="publish_btn" style="border:none;font-size:15px;" name="Auto">Publish</button>  
              
                   
               </div>

          </div>
      </div>
      
</div>
</form>

<?php

    if(isset($_POST['Normal'])){

       $PID = "";
       $last_value_sql = "SELECT Post_ID FROM news ORDER BY Post_ID DESC LIMIT 1";
       $last_value_statement = $conn->query($last_value_sql);
       $last_value_results = $last_value_statement->fetchAll(PDO::FETCH_ASSOC);

       if ($last_value_results) {
        foreach ($last_value_results as $last_value_result) {
          $connect = substr($last_value_result['Post_ID'], 5) + 1;
          $PID = "NL-N-" . $connect;
        }
       }

          $P_Date = date("Y-m-d");
          $Smart_Date = $_POST['Smart_Date'];
          $Up = 0;
          $Down = 0;

          if($Smart_Date == NULL){
            $Accept_stmt = $conn->prepare("INSERT INTO `news`(`Post_ID`,`Title`,`Publish_Date`,`Image`,`Details`,`News_Category`,`Creator_ID`,`up_count`,`down_count`) VALUES(?,?,?,?,?,?,?,?,?)");
            $Accept_stmt->execute([$PID,$Title,$P_Date,$img_X,$msg,$News_Category,$Creator_ID,$Up,$Down]);
          }
          else{
            $Accept_stmt = $conn->prepare("INSERT INTO `news` VALUES(?,?,?,?,?,?,?,?,?,?)");
            $Accept_stmt->execute([$PID,$Title,$P_Date,$img_X,$msg,$News_Category,$Creator_ID,$Smart_Date,$Up,$Down]);


            $POST_AREA = [
              'NEW_ID' => $PID,
              'OLD_ID' => $Post_ID
            ];
            
            $POST_AREA_Update_sql = 'UPDATE post_area
                                      SET Post_ID = :NEW_ID
                                      WHERE Post_ID = :OLD_ID';
            
            $POST_AREA_Update_statement = $conn->prepare($POST_AREA_Update_sql);
            
            $POST_AREA_Update_statement->bindParam(':NEW_ID', $POST_AREA['NEW_ID']);
            $POST_AREA_Update_statement->bindParam(':OLD_ID', $POST_AREA['OLD_ID']);
            
            $POST_AREA_Update_statement->execute();


            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$PID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  $smart_calandar_stmt = $conn->prepare("INSERT INTO `smart_calendar` (`evt_start`,`evt_end`,`Post_Id`,`Area`) VALUES(?,?,?,?)");
                  $smart_calandar_stmt->execute([$Smart_Date,$Smart_Date,$PID,$post_from_result['Area']]);
               }
            }
          }

          $P_Time = NULL;
          $Count = 0;
          $Type = "News";
          $Readtime_stmt = $conn->prepare("INSERT INTO `read_time` VALUES(?,?,?,?,?)");
          $Readtime_stmt->execute([$PID,$Count,$P_Time,$P_Time,$Type]);

          // Notification
          $notification = $conn->prepare("INSERT INTO `notification`(`Post_ID`,`Approve_or_Reject`,`System_Actor_ID`,`Date`,`Time`,`Moderator_ID`,`Title`) VALUES(?,?,?,?,?,?,?)");
          $notification->execute([$Post_ID,'Approve',$Creator_ID,$Computer_Date,$Computer_Time,$System_Actor_ID,$Title]);

          // Update Moderator Insights Part//
            $News_Count = 1;
            $Modertsor_Ingihts_sql = "SELECT * FROM moderate_insights WHERE System_Actor_Id = '$System_Actor_ID'";
            $Modertsor_Ingihts_statement = $conn->query($Modertsor_Ingihts_sql);
            $Modertsor_Ingihts_results = $Modertsor_Ingihts_statement->fetchAll(PDO::FETCH_ASSOC);

            if($Modertsor_Ingihts_results){
              foreach($Modertsor_Ingihts_results as $Modertsor_Ingihts_result){
                $News_Count = $Modertsor_Ingihts_result['News'] + 1;
                $Moderator_Insights = [
                  'System_Actor_ID' => $System_Actor_ID,
                  'News_Count' => $News_Count
                ];
                
                $Moderator_Insights_Update_sql = 'UPDATE moderate_insights
                                                  SET News = :News_Count
                                                  WHERE System_Actor_Id = :System_Actor_ID';
                
                $Moderator_Insights_Update_statement = $conn->prepare($Moderator_Insights_Update_sql);
                
                $Moderator_Insights_Update_statement->bindParam(':System_Actor_ID', $Moderator_Insights['System_Actor_ID']);
                $Moderator_Insights_Update_statement->bindParam(':News_Count', $Moderator_Insights['News_Count']);
                
                $Moderator_Insights_Update_statement->execute();
              }
            }
            else{
              $Moderator_Insights_insert_sql = $conn->prepare("INSERT INTO `moderate_insights`(`System_Actor_Id`,`News`) VALUES(?,?)");
              $Moderator_Insights_insert_sql->execute([$System_Actor_ID,$News_Count]);
            }

          // End Update Moderator Insights Part//

          // Update Repoter Insights Part//
            $News_Count = 1;
            $Repoter_Ingihts_sql = "SELECT * FROM reporter_insights WHERE System_Actor_Id = '$Creator_ID'";
            $Repoter_Ingihts_statement = $conn->query($Repoter_Ingihts_sql);
            $Repoter_Ingihts_results = $Repoter_Ingihts_statement->fetchAll(PDO::FETCH_ASSOC);

            if($Repoter_Ingihts_results){
              foreach($Repoter_Ingihts_results as $Repoter_Ingihts_result){
                $News_Count = $Repoter_Ingihts_result['News'] + 1;
                $Repoter_Insights = [
                  'System_Actor_ID' => $Creator_ID,
                  'News_Count' => $News_Count
                ];
                
                $Repoter_Insights_Update_sql = 'UPDATE reporter_insights
                                                  SET News = :News_Count
                                                  WHERE System_Actor_Id = :System_Actor_ID';
                
                $Repoter_Insights_Update_statement = $conn->prepare($Repoter_Insights_Update_sql);
                
                $Repoter_Insights_Update_statement->bindParam(':System_Actor_ID', $Repoter_Insights['System_Actor_ID']);
                $Repoter_Insights_Update_statement->bindParam(':News_Count', $Repoter_Insights['News_Count']);
                
                $Repoter_Insights_Update_statement->execute();
              }
            }
            else{
              $Repoter_Insights_insert_sql = $conn->prepare("INSERT INTO `reporter_insights`(`System_Actor_Id`,`News`) VALUES(?,?)");
              $Repoter_Insights_insert_sql->execute([$Creator_ID,$News_Count]);
            }

          // End Update Repoter Insights Part//
          
          $sql = 'DELETE FROM news_pending
          WHERE Post_ID = :Post_ID';

          // prepare the statement for execution
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);

          // execute the statement  
          if($statement->execute()){
            echo "<script>window.open('Moderator_Pending.php','_self')</script>";
          }
  }
    if(isset($_POST['Auto'])){

          $PID = "";
          $last_value_sql = "SELECT Post_ID FROM news ORDER BY Post_ID DESC LIMIT 1";
          $last_value_statement = $conn->query($last_value_sql);
          $last_value_results = $last_value_statement->fetchAll(PDO::FETCH_ASSOC);

          if ($last_value_results) {
          foreach ($last_value_results as $last_value_result) {
            $connect = substr($last_value_result['Post_ID'], 5) + 1;
            $PID = "NL-N-" . $connect;
          }
          }

          $P_Date = date("Y-m-d");
          $Smart_Date = $_POST['Smart_Date'];
          $Date = $_POST['Auto_Date'];
          $Time = $_POST['Auto_time'];
          $Cat = "News";
          $Up = 0;
          $Down = 0;

          if($Smart_Date == NULL){
            $Accept_stmt = $conn->prepare("INSERT INTO `news`(`Post_ID`,`Title`,`Publish_Date`,`Image`,`Details`,`News_Category`,`Creator_ID`,`up_count`,`down_count`) VALUES(?,?,?,?,?,?,?,?,?)");
            $Accept_stmt->execute([$PID,$Title,$P_Date,$img_X,$msg,$News_Category,$Creator_ID,$Up,$Down]);
          }
          else{
            $Accept_stmt = $conn->prepare("INSERT INTO `news` VALUES(?,?,?,?,?,?,?,?,?,?)");
            $Accept_stmt->execute([$PID,$Title,$P_Date,$img_X,$msg,$News_Category,$Creator_ID,$Smart_Date,$Up,$Down]);


            $POST_AREA = [
              'NEW_ID' => $PID,
              'OLD_ID' => $Post_ID
            ];
            
            $POST_AREA_Update_sql = 'UPDATE post_area
                                      SET Post_ID = :NEW_ID
                                      WHERE Post_ID = :OLD_ID';
            
            $POST_AREA_Update_statement = $conn->prepare($POST_AREA_Update_sql);
            
            $POST_AREA_Update_statement->bindParam(':NEW_ID', $POST_AREA['NEW_ID']);
            $POST_AREA_Update_statement->bindParam(':OLD_ID', $POST_AREA['OLD_ID']);
            
            $POST_AREA_Update_statement->execute();



            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$PID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  $smart_calandar_stmt = $conn->prepare("INSERT INTO `smart_calendar` (`evt_start`,`evt_end`,`Post_Id`,`Area`) VALUES(?,?,?,?)");
                  $smart_calandar_stmt->execute([$Smart_Date,$Smart_Date,$PID,$post_from_result['Area']]);
               }
            }
          }

        
          $Auto_delete_stmt = $conn->prepare("INSERT INTO `post_auto_delete` VALUES(?,?,?,?)");
          $Auto_delete_stmt->execute([$PID,$Date,$Time,$Cat]);

          $P_Time = NULL;
          $Count = 0;
          $Type = "News";
          $Readtime_stmt = $conn->prepare("INSERT INTO `read_time` VALUES(?,?,?,?,?)");
          $Readtime_stmt->execute([$PID,$Count,$P_Time,$P_Time,$Type]);

          // Notification
          $notification = $conn->prepare("INSERT INTO `notification`(`Post_ID`,`Approve_or_Reject`,`System_Actor_ID`,`Date`,`Time`,`Moderator_ID`,`Title`) VALUES(?,?,?,?,?,?,?)");
          $notification->execute([$Post_ID,'Approve',$Creator_ID,$Computer_Date,$Computer_Time,$System_Actor_ID,$Title]);

          // Update Moderator Insights Part//
            $News_Count = 1;
            $Modertsor_Ingihts_sql = "SELECT * FROM moderate_insights WHERE System_Actor_Id = '$System_Actor_ID'";
            $Modertsor_Ingihts_statement = $conn->query($Modertsor_Ingihts_sql);
            $Modertsor_Ingihts_results = $Modertsor_Ingihts_statement->fetchAll(PDO::FETCH_ASSOC);

            if($Modertsor_Ingihts_results){
              foreach($Modertsor_Ingihts_results as $Modertsor_Ingihts_result){
                $News_Count = $Modertsor_Ingihts_result['News'] + 1;
                $Moderator_Insights = [
                  'System_Actor_ID' => $System_Actor_ID,
                  'News_Count' => $News_Count
                ];
                
                $Moderator_Insights_Update_sql = 'UPDATE moderate_insights
                                                  SET News = :News_Count
                                                  WHERE System_Actor_Id = :System_Actor_ID';
                
                $Moderator_Insights_Update_statement = $conn->prepare($Moderator_Insights_Update_sql);
                
                $Moderator_Insights_Update_statement->bindParam(':System_Actor_ID', $Moderator_Insights['System_Actor_ID']);
                $Moderator_Insights_Update_statement->bindParam(':News_Count', $Moderator_Insights['News_Count']);
                
                $Moderator_Insights_Update_statement->execute();
              }
            }
            else{
              $Moderator_Insights_insert_sql = $conn->prepare("INSERT INTO `moderate_insights`(`System_Actor_Id`,`News`) VALUES(?,?)");
              $Moderator_Insights_insert_sql->execute([$System_Actor_ID,$News_Count]);
            }

          // End Update Moderator Insights Part//

         // Update Repoter Insights Part//
          $News_Count = 1;
          $Repoter_Ingihts_sql = "SELECT * FROM reporter_insights WHERE System_Actor_Id = '$Creator_ID'";
          $Repoter_Ingihts_statement = $conn->query($Repoter_Ingihts_sql);
          $Repoter_Ingihts_results = $Repoter_Ingihts_statement->fetchAll(PDO::FETCH_ASSOC);

          if($Repoter_Ingihts_results){
            foreach($Repoter_Ingihts_results as $Repoter_Ingihts_result){
              $News_Count = $Repoter_Ingihts_result['News'] + 1;
              $Repoter_Insights = [
                'System_Actor_ID' => $Creator_ID,
                'News_Count' => $News_Count
              ];
              
              $Repoter_Insights_Update_sql = 'UPDATE reporter_insights
                                                SET News = :News_Count
                                                WHERE System_Actor_Id = :System_Actor_ID';
              
              $Repoter_Insights_Update_statement = $conn->prepare($Repoter_Insights_Update_sql);
              
              $Repoter_Insights_Update_statement->bindParam(':System_Actor_ID', $Repoter_Insights['System_Actor_ID']);
              $Repoter_Insights_Update_statement->bindParam(':News_Count', $Repoter_Insights['News_Count']);
              
              $Repoter_Insights_Update_statement->execute();
            }
          }
          else{
            $Repoter_Insights_insert_sql = $conn->prepare("INSERT INTO `reporter_insights`(`System_Actor_Id`,`News`) VALUES(?,?)");
            $Repoter_Insights_insert_sql->execute([$Creator_ID,$News_Count]);
          }
 
         // End Update Repoter Insights Part//
           
          $sql = 'DELETE FROM news_pending
          WHERE Post_ID = :Post_ID';

          // prepare the statement for execution
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);

          // execute the statement  
          if($statement->execute()){
            echo "<script>window.open('Moderator_Pending.php','_self')</script>";
          }
    }
?>  



<script>


    function togglePopup_select_option(){
      document.getElementById("popup-6").classList.toggle("active");
    } 
    function add_smart_calendar_Popup(){
      document.getElementById("popup-6").classList.toggle("active");
      document.getElementById("popup-7").classList.toggle("active");
    }   

    function select_mode_Popup(){
      document.getElementById("popup-6").classList.remove("active");
      document.getElementById("popup-7").classList.remove("active");
      document.getElementById("popup-8").classList.add("active");
    }   
    
    function remove_mode_Popup(){
      document.getElementById("popup-8").classList.remove("active");
    }   

    function auto_mode_Popup(){
      document.getElementById("popup-9").classList.toggle("active");
      document.getElementById("popup-8").classList.remove("active");
    }   
</script>
    

</body>
</html>