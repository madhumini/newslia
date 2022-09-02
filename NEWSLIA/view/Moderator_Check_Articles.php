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
    height: 240px;
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
  }

  .back_btn{
    margin-top:15.2rem;
    background-color:#ADD8E6;
    margin-left:3rem;
    color:#222;
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

  .posts_content_view_body{
  margin-top:3rem;
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

      $Post_ID = $_SESSION['SAVE_READ_Post_Article_ID'];
      
      $Post = [
        'Post_ID' => $Post_ID,
        'NormalUser_Can_Edit' => '0'
      ];
      
      $sql = 'UPDATE articles_pending
              SET NormalUser_Can_Edit = :NormalUser_Can_Edit
              WHERE Post_ID = :Post_ID';
      
      $statement = $conn->prepare($sql);
      
      $statement->bindParam(':Post_ID', $Post['Post_ID']);
      $statement->bindParam(':NormalUser_Can_Edit', $Post['NormalUser_Can_Edit']);
      
      $statement->execute();

      $pending_read_sql = "SELECT * FROM articles_pending WHERE Post_ID='$Post_ID'";
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

                </div>

                <div class='box-read'>
                  <h2>".$Title."</h2>
                  <p>".$msg."</p>
                </div>
          </div>";
?>

    <div class="button-set">
        <form action="" method="post">
                  <button class="view_btn update_btn" name = "Accept" style = "border:none;">Accept</button>
        </form>
        <form action="" method="post">
                  <button class="view_btn remove_btn" name = "Reject" style = "border:none;">Reject</button>
        </form>
        <div class="view_btn back_btn" onclick="window.open('./Moderator_Pending.php', '_self')">Back</div>
    </div>
</div>

<?php

    $P_Date = date("Y-m-d");
    $System_Time = date("H:i:s");
    $System_Actor_ID = $_SESSION['System_Actor_ID'];
    
    if(isset($_POST['Reject'])){

      // Notification
      $notification = $conn->prepare("INSERT INTO `notification`(`Post_ID`,`Approve_or_Reject`,`System_Actor_ID`,`Date`,`Time`,`Moderator_ID`,`Title`) VALUES(?,?,?,?,?,?,?)");
      $notification->execute([$Post_ID,'Reject',$Creator_ID,$P_Date,$System_Time,$System_Actor_ID,$Title]);

      $sql = 'DELETE FROM articles_pending
        WHERE Post_ID = :Post_ID';

      // prepare the statement for execution
      $statement = $conn->prepare($sql);
      $statement->bindParam(':Post_ID', $Post_ID);

      // execute the statement  
      if($statement->execute()){
        echo "<script>window.open('Moderator_Pending.php','_self')</script>";
      } 
    }

    if(isset($_POST['Accept'])){

        $PID = ""; 
        $last_value_sql = "SELECT Post_ID FROM articles ORDER BY Post_ID DESC LIMIT 1";
        $last_value_statement = $conn->query($last_value_sql);
        $last_value_results = $last_value_statement->fetchAll(PDO::FETCH_ASSOC);
  
        if ($last_value_results) {
          foreach ($last_value_results as $last_value_result) {
            $connect = substr($last_value_result['Post_ID'], 5) + 1;
            $PID = "NL-A-" . $connect;
          }
        }


        $Approve_stmt = $conn->prepare("INSERT INTO `articles` VALUES(?,?,?,?,?,?)");
        $Approve_stmt->execute([$PID,$Title,$P_Date,$img_X,$msg,$Creator_ID]);

        $P_Time = NULL;
        $Readtime_stmt = $conn->prepare("INSERT INTO `read_time` VALUES(?,?,?,?,?)");
        $Readtime_stmt->execute([$PID,'0',$P_Time,$P_Time,'Articles']);

        // Notification
        $notification = $conn->prepare("INSERT INTO `notification`(`Post_ID`,`Approve_or_Reject`,`System_Actor_ID`,`Date`,`Time`,`Moderator_ID`,`Title`) VALUES(?,?,?,?,?,?,?)");
        $notification->execute([$PID,'Approve',$Creator_ID,$P_Date,$System_Time,$System_Actor_ID,$Title]);


        // Update Moderator Insights Part//
          $Article_Count = 1;
          $Modertsor_Ingihts_sql = "SELECT * FROM moderate_insights WHERE System_Actor_Id = '$System_Actor_ID'";
          $Modertsor_Ingihts_statement = $conn->query($Modertsor_Ingihts_sql);
          $Modertsor_Ingihts_results = $Modertsor_Ingihts_statement->fetchAll(PDO::FETCH_ASSOC);

          if($Modertsor_Ingihts_results){
            foreach($Modertsor_Ingihts_results as $Modertsor_Ingihts_result){
              $Article_Count = $Modertsor_Ingihts_result['Articles'] + 1;
              $Moderator_Insights = [
                'System_Actor_ID' => $System_Actor_ID,
                'Article_Count' => $Article_Count
              ];
              
              $Moderator_Insights_Update_sql = 'UPDATE moderate_insights
                                                SET Articles = :Article_Count
                                                WHERE System_Actor_Id = :System_Actor_ID';
              
              $Moderator_Insights_Update_statement = $conn->prepare($Moderator_Insights_Update_sql);
              
              $Moderator_Insights_Update_statement->bindParam(':System_Actor_ID', $Moderator_Insights['System_Actor_ID']);
              $Moderator_Insights_Update_statement->bindParam(':Article_Count', $Moderator_Insights['Article_Count']);
              
              $Moderator_Insights_Update_statement->execute();
            }
          }
          else{
            $Moderator_Insights_insert_sql = $conn->prepare("INSERT INTO `moderate_insights`(`System_Actor_Id`,`Articles`) VALUES(?,?)");
            $Moderator_Insights_insert_sql->execute([$System_Actor_ID,$Article_Count]);
          }

        // End Update Moderator Insights Part//

        $sql = 'DELETE FROM articles_pending
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


</body>
</html>