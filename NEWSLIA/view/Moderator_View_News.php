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
    <link rel="stylesheet" href="../css/Image_Slider.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>

<style>
  body {
    /*overflow-x: hidden; /* Hide scrollbars */
  }
  .post_sort{
      padding-left:80px;
  }
  .box-container{
    height: 290px;
  }
  .popular_famous_container{
    height: 300px;
  }

  .posts_content_view_head{
    font-size:x-large;
    margin-left:-1rem;
  }
  
  .drop_area_sort{
    margin-left: -2vw;
  }

  .popular_famous_middel {
    display: flex;
    flex-direction: row;
    justify-content: right;
    margin-top: -7.5rem;
    margin-left: 0.5rem;
  }

  .left_side{
    margin-left:6rem; 
  }
  .right_side{
    margin-right:7rem;
  }

 .arrow:hover{
  cursor: pointer;
 }
  
 .vie{
    margin-left:1rem;
 }

.drop_area_sort_cont{
  margin-left:-2rem;
}

.pop_more{
  margin-top: 1rem;
}

.popular_famous{
    margin-left:-2rem;
}
.poupular_famous{
    width:23%;
    height:25%;
    padding-bottom:1rem;
    margin-left:-3rem;
}

.poupular_famous:hover{
    transform:scale(1);
}
.popular_famous_middel{
    margin-top:-7rem;
    margin-left:0rem;
}
.box_head:hover img{
    opacity: 0.4;
  }
.box_head:hover .picture{
    opacity: 0.3;
  }
.popular{
      margin-left:-1rem;
 }
.popular_title{
    margin-left:-4rem;
}

.news_type{
  margin-left:3rem;
}

.body_information{
    margin-left:-3rem;
    margin-top:-1rem;
}

.normal_box{
  margin-left:3rem;
  height:260px;
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

  .most_popular_recent{
    display:flex;
    flex-direction:row;
    margin-top:-5rem;
  }

  /*.slider{
    width: 350px;
  	height: 250px;
  }

  .slide img{
    width: 350px;
  	height: 250px;
  }
  .navigation-manual{
	  margin-top: -300px;
    margin-left: -240px;
  }*/


  .complain_submit{
    border: none;
    background: #00B172EB;
    padding: 5px;
    border-radius: 5px;
    margin-top: 10px;
    cursor: pointer;
  }


</style>


<body>

  
<!--navigation-->

<?php $page = 'view';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->

<!-- Start Auto Delete Posts -->

<?php
  include '../Model/connect.php';

  $Type = "News";
  $System_Date = date("Y-m-d");
  $System_Time = date("H:i:s");

  $post_delete = "SELECT * FROM post_auto_delete WHERE Type='$Type' AND Date <= '$System_Date'";
  $post_delete_state = $conn->query($post_delete);
  $post_delete_results = $post_delete_state->fetchAll(PDO::FETCH_ASSOC);

  if($post_delete_results){
      foreach($post_delete_results as $post_delete_result){
        $flag = 0;
        
        if($post_delete_result['Date'] == $System_Date and $post_delete_result['Time'] < $System_Time){
          $flag = 1;
        }
        elseif($post_delete_result['Date'] < $System_Date){
          $flag = 1; 
        }
        
        if($flag == 1){
          $Post_ID = $post_delete_result['Post_ID'];
          
          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM read_time WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM reminder WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM hidden WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM save WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM post_area WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          if($statement->execute()){
            echo $statement_Area->rowCount();
          }

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM news WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM post_auto_delete WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM smart_calendar WHERE Post_Id = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql = 'DELETE FROM vote WHERE Post_ID = :Post_ID';
          
          $statement = $conn->prepare($sql);
          $statement->bindParam(':Post_ID', $Post_ID);
          $statement->execute();

          /////////////////////////////////////////////////////////////////////////////
          $sql_get_all_vote = "SELECT COUNT(Vote) AS COUNT_VOTE FROM vote WHERE Vote = '-1' GROUP BY = '$Post_ID'";
          $statement_get_all_vote = $conn->query($sql_get_all_vote);
          $results_get_all_vote = $statement_get_all_vote->fetchAll(PDO::FETCH_ASSOC);
          
          if($results_get_all_vote){
            foreach($results_get_all_vote as $result_get_all_vote){
                $count_vote = $result_get_all_vote['COUNT_VOTE'];
                if($count_vote > 10){
                  $Type = "News";
                  $System_Date = date("Y-m-d");
                  $System_Time = date("H:i:s");


                  $Add_Vote = $conn->prepare("INSERT INTO `post_auto_delete` VALUES(?,?,?,?)");
                  $Add_Vote->execute([$Post_ID,$System_Date,$System_Time,$Type]);
                }
            }
          }
         


        }
        
      }
  }
?>

<!-- End Auto Delete Posts -->



<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        News
    </div>
</div>



<center>

<div class="main" style="margin-left:-2rem;">

 <!-- (B) PERIOD SELECTOR -->
 <div id="calPeriod">
   
   <?php
   // (B1) MONTH SELECTOR
   // NOTE: DEFAULT TO CURRENT SERVER MONTH YEAR
   $months = [
     1 => "January", 2 => "Febuary", 3 => "March", 4 => "April",
     5 => "May", 6 => "June", 7 => "July", 8 => "August",
     9 => "September", 10 => "October", 11 => "November", 12 => "December"
   ];
   $monthNow = date("m");
   echo "<select id='calmonth'>";
   foreach ($months as $m=>$mth) {
     printf("<option value='%s'%s>%s</option>",
       $m, $m==$monthNow?" selected":"", $mth
     );
   }
   echo "</select>";

   // (B2) YEAR SELECTOR
   echo "<input type='number' id='calyear' value='".date("Y")."'/>";
 ?>

 </div>

 <!-- (C) CALENDAR WRAPPER -->
 <div id="calwrap">
 </div>

</center>



<div class="posts_content_view_body popular_famous">

      <div class="most_popular_recent">
        
        <?php   
          include './Moderator_View_Popular_Recent.php';

          echo "<div>
          
          ".Most_Recent("News")."
        
          </div>
          <div>

          ".Most_Popular("News")."
          
          </div>";
          

        ?>
      </div>
    <br>
    <br>

</div>

    </div>

</div>



<br>
<hr>
<div class="content_posts_view"> 

      <div class="post_sort">
        <div class="post_sort_bar">
          <button onclick="showsort()" class="drop_area_sort">Select Area<img src="../images/sort.svg" alt="" srcset=""></button>
          <div class="drop_area_sort_cont" id="sortdrop">
            <img src="../images/search.svg" alt="" srcset="">
            <input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Search...">
            
          </div>
        </div>
      </div>


     
</div>



<div class="posts_content_view_body">

    <div class="body_information"  id = 'content_sort'>
         
    <?php
        
        $table = 'News';
        $USERID = $_SESSION['System_Actor_ID'];
        
        if($_SESSION['Actor_Type'] != "ADMIN"){
              $post_area_sql = "SELECT DISTINCT post_area.Post_ID as PI FROM post_area INNER JOIN read_area ON post_area.Area = read_area.Area WHERE post_area.`Post Type` = 'NEWS' AND read_area.System_Actor_Id = '$USERID' ORDER BY post_area.Post_ID DESC";
              $post_area_state = $conn->query($post_area_sql);
              $post_area_results = $post_area_state->fetchAll(PDO::FETCH_ASSOC);
              
              if($post_area_results){
                foreach($post_area_results as $post_area_result){

                  $ID = $post_area_result['PI'];
                        
                  $post_info_sql = "SELECT * FROM news WHERE Post_ID = '$ID'";                        
                  $post_info_state = $conn->query($post_info_sql);
                  $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
                        if($post_info_results){
                            foreach($post_info_results as $post_info_result){

                                $flag = 1;
                                
                                $Post_ID = $post_info_result['Post_ID'];

                                $remove_hidden_info_sql = "SELECT * FROM hidden WHERE Post_ID = '$Post_ID'";                        
                                $remove_hidden_info_state = $conn->query($remove_hidden_info_sql);
                                $remove_hidden_info_results = $remove_hidden_info_state->fetchAll(PDO::FETCH_ASSOC);

                                if($remove_hidden_info_results){
                                      $flag = 0;
                                }

                                if($flag == 1){
                                $Type = $table;

                                $img = $post_info_result['Image'];
                                $img = base64_encode($img);
                                $text = pathinfo($post_info_result['Post_ID'], PATHINFO_EXTENSION);

                                $TITLE = $post_info_result['Title'];
                                $P_DATE = $post_info_result['Publish_Date'];
                                $Creator_ID = $post_info_result['Creator_ID'];
                                $News_Category = $post_info_result['News_Category'];
                                      

                                echo "<div class='box-container'>
                                      <div class='box_head'>
                                        <img src='data:image/".$text.";base64,".$img."'/>
                                        
                                        <div class='tag'>
                                          <div class='tag_text'>".$Type."</div>
                                        </div>
                                        
                                        <div class='middle'>
                                            <div class='view_btn'>
                                                <ul>
                                                  <li onclick=toggle_view('$Post_ID','NEWS');><a href='#'>View</a></li>
                                                </ul>
                                                        
                                            </div>
                                            
                                        </div>
                                      </div>
                                      
                                      <div class='box_body'>";

                                      include './Last_Read.php';  
                                        
                                      echo "<h3>".$TITLE."</h3>";
                                        
                                      
                                      echo "<h3 style='display:none;'>".$News_Category."</h3>";
                                        
                                      echo "<p>".$P_DATE."</p>";
                                        

                                        $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                                        $post_from_state = $conn->query($post_from_sql);
                                        $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

                                        if($post_from_results){
                                            echo "<b><i>-</b></i>";
                                          foreach($post_from_results as $post_from_result){
                                            echo "<i><abc>".$post_from_result['Area']."</abc> - ";
                                            echo "</i>";
                                          }
                                        }

                                        echo "<br>";
                                      
                                        $post_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                                        $post_who_state = $conn->query($post_who_sql);
                                        $post_who_results = $post_who_state->fetchAll(PDO::FETCH_ASSOC);

                                        if($post_who_results){
                                          foreach($post_who_results as $post_who_result){
                                            echo "<p>".$post_who_result['FirstName']." ".$post_who_result['LastName']."</p>";    
                                          }
                                        }

                                      echo "
                                      </div>
                                      <div class='more'>
                                        <img src='../images/More.svg'>
                                        <ul class ='more_post'>
                                          <li onclick=toggle_save('$Post_ID','NEWS');><a href='#'>Save</a></li>
                                          <li onclick=toggle_hidden('$Post_ID','NEWS');><a href='#'>Hide</a></li>
                                          <li onclick=toggle_reminder('$Post_ID','NEWS');><a href='#'>Reminder</a></li>";
                                          

                                          if($_SESSION['Actor_Type'] == "NORMALUSER" || $_SESSION['Actor_Type'] == "REPORTER"){

                                            echo "<li onclick=togglePopup_Complain_News_Id('$Post_ID'); ><a href='#'>Complain</a></li>";

                                          }

                                      echo "</ul>
                                      </div>
                                    </div>";

                                      }

                                  }
                            }
                          
        
                }
              }
            }
            
        else{
          $post_info_sql = "SELECT * FROM news";                        
          $post_info_state = $conn->query($post_info_sql);
          $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
                if($post_info_results){
                    foreach($post_info_results as $post_info_result){

                        $flag = 1;
                        
                        $Post_ID = $post_info_result['Post_ID'];

                        $remove_hidden_info_sql = "SELECT * FROM hidden WHERE Post_ID = '$Post_ID'";                        
                        $remove_hidden_info_state = $conn->query($remove_hidden_info_sql);
                        $remove_hidden_info_results = $remove_hidden_info_state->fetchAll(PDO::FETCH_ASSOC);

                        if($remove_hidden_info_results){
                              $flag = 0;
                        }

                        if($flag == 1){
                        $Type = $table;

                        $img = $post_info_result['Image'];
                        $img = base64_encode($img);
                        $text = pathinfo($post_info_result['Post_ID'], PATHINFO_EXTENSION);

                        $TITLE = $post_info_result['Title'];
                        $P_DATE = $post_info_result['Publish_Date'];
                        $Creator_ID = $post_info_result['Creator_ID'];
                        $News_Category = $post_info_result['News_Category'];
                              

                        echo "<div class='box-container'>
                              <div class='box_head'>
                                <img src='data:image/".$text.";base64,".$img."'/>
                                
                                <div class='tag'>
                                  <div class='tag_text'>".$Type."</div>
                                </div>
                                
                                <div class='middle'>
                                    <div class='view_btn'>
                                        <ul>
                                          <li onclick=toggle_view('$Post_ID','NEWS');><a href='#'>View</a></li>
                                        </ul>
                                                
                                    </div>
                                    
                                </div>
                              </div>
                              
                              <div class='box_body'>";

                              include './Last_Read.php';  
                                
                              echo "<h3>".$TITLE."</h3>";
                                
                              
                              echo "<h3 style='display:none;'>".$News_Category."</h3>";
                                
                              echo "<p>".$P_DATE."</p>";
                                

                                $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
                                $post_from_state = $conn->query($post_from_sql);
                                $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

                                if($post_from_results){
                                    echo "<b><i>-</b></i>";
                                  foreach($post_from_results as $post_from_result){
                                    echo "<i><abc>".$post_from_result['Area']."</abc> - ";
                                    echo "</i>";
                                  }
                                }

                                echo "<br>";
                              
                                $post_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                                $post_who_state = $conn->query($post_who_sql);
                                $post_who_results = $post_who_state->fetchAll(PDO::FETCH_ASSOC);

                                if($post_who_results){
                                  foreach($post_who_results as $post_who_result){
                                    echo "<p>".$post_who_result['FirstName']." ".$post_who_result['LastName']."</p>";    
                                  }
                                }

                              echo "
                              </div>
                              <div class='more'>
                                <img src='../images/More.svg'>
                                <ul class ='more_post'>
                                  <li onclick=toggle_save('$Post_ID','NEWS');><a href='#'>Save</a></li>
                                  <li onclick=toggle_hidden('$Post_ID','NEWS');><a href='#'>Hide</a></li>
                                  <li onclick=toggle_reminder('$Post_ID','NEWS');><a href='#'>Reminder</a></li>
                                  <li onclick=toggle_delete('$Post_ID','NEWS');><a href='#'>Delete</a></li>";
                                  

                                

                                  if($_SESSION['Actor_Type'] == "NORMALUSER" || $_SESSION['Actor_Type'] == "REPORTER"){

                                    echo "<li onclick=togglePopup_Complain_News_Id('$Post_ID'); ><a href='#'>Complain</a></li>";

                                  }

                              echo "</ul>
                              </div>
                            </div>";

                              }

                          }
                    }
        }
    ?>

    </div>

</div>



<div class="popup popup_set_time" id="popup-6">
    <div class="overlay"></div>
    <div class="content popup_set_time" style="top: 60%; width: 350px; height: 360px;">
      <div class="close-btn" onclick="togglePopup_Complain_News_Id('popup-6')">&times;</div>
      
      <div class="content_body popup_set_time_body">
          <div class="popup_logo">
              <img src="../images/Name.svg" alt="" srcset="">
          </div>
          <hr>

          <div class="popup_form">
              <h3 class="popup_title">Add Your Complain</h3>
              
              <form action="../Control/save_hidden.php" method="post">
               
                <label class="lbl"> Complain Type</label>
                
                <input id="Complain_News_Id"  class="p-div-2" style="border: none; display:none;" name="NewsId" >

                <Select class="p-div-2" style="border:none; width:16rem; height:2rem; margin-top:0.5rem; margin-left:1rem;" name="Type" required>
                  
                   <option >Nudity</option>
                   <option >Violence</option>
                   <option >Harassment</option>
                   <option >Suicide or self-injury</option>
                   <option >False information</option>
                   <option >Spam</option>
                   <option >Unauthorised sales</option>
                   <option >Hate speech</option>
                   <option >Terrorism</option>
                   <option >Something else</option>

                </Select>


                <br>

                <div class="lable-div-2"><label for="">Description :</label></div>
                <textarea placeholder="Describe complaign" class="text-area-2" cols="26" rows="5" style="height: 60px;" name="Description" re-quired></textarea>
            
                                  
                  <br>
                  <button type="submit" name ="Complain" class="update_btn" value="LOGIN">Set</button>
              
                 
              </form>
          </div>

      
      </div>
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

    function toggle_delete(delete_news_post_id,Type){
      $.ajax({
        url : '../Control/post_control.php',
        type: "POST",
        data :{delete_news_post_id:delete_news_post_id,
          Type:Type},
        success:function(data){
          //alert("Welcome to Geeks for Geeks work");
          window.open("./Moderator_View_News.php","_self");
        }
      })

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

    function toggle_save(save_post_id,Type){
      $.ajax({
        url : '../Control/post_control.php',
        type: "POST",
        data :{save_post_id:save_post_id,
          Type:Type},
        success:function(data){
          window.open("./Moderator_View_News.php","_self");
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
          window.open("./Moderator_View_News.php","_self");
        }
      })
    }

    function toggle_view(view_post_id,Type){
      $.ajax({
        url : "../Control/post_control.php",
        type :"POST",
        data :{view_post_id:view_post_id,
          Type:Type},
        success:function(){
          window.open("./Moderator_View_Post_Read.php","_self");
        }
      })
    }

    function set_time_to_publish_Popup(){
      document.getElementById("popup-8").classList.toggle("active");
    } 

    function showsort() {
      document.getElementById("sortdrop").classList.toggle("show");
    }

    function show_news_sort() {
      document.getElementById("sort_news_drop").classList.toggle("show");
    }


    //complain 

    function togglePopup_Complain_News_Id(Post_Id) {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("Complain_News_Id").value = Post_Id;
      }
      xhttp.open("GET", Post_Id);
      xhttp.send();

      document.getElementById('popup-6').classList.toggle("active");
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