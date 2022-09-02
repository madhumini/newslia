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
    <link rel="stylesheet" href="../css/Image_Slider.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  .post_sort{
      padding-left:80px;
  }
  .box-container{
    height: 290px;
    margin-left:1rem;
  }
  .popular_famous_container{
    height: 320px;
  }

  .posts_content_view_head{
    font-size:x-large;
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
    padding-left:9rem;
  }
  .right_side{
    padding-right:9rem;
  }
  
.drop_area_sort_cont{
  margin-left:-2rem;
}

.pop_more{
  margin-top: 1rem;
}

.body_information{
     margin-left:-3rem;
     margin-top:-1rem; 
}

.normal_box{
  margin-left:3rem;
  height:260px;
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

  .most_popular_recent{
    display:flex;
    flex-direction:row;
  }
  
</style>

<body>

 
<!--navigation-->

<?php $page = 'view';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Articles
    </div>
</div>


<div class="most_popular_recent">
  
  <?php   
    include './Moderator_View_Popular_Recent.php';

    echo "<div>
    
    ".Most_Recent("Articles")."
  
    </div>
    <div>

    ".Most_Popular("Articles")."
    
    </div>";
    

  ?>
</div>



<hr>
<div class="content_posts_view">

      
    
</div>



<div class="posts_content_view_body">

    <div class="body_information">
         
    <?php
      include '../Model/connect.php';
      $table = 'Articles';
      $post_info_sql = "SELECT * FROM articles ORDER BY Publish_Date DESC";                        
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
              $Post_ID = $post_info_result['Post_ID'];
              $Type = $table;
        
              $img = $post_info_result['Image'];
              $img = base64_encode($img);
              $text = pathinfo($post_info_result['Post_ID'], PATHINFO_EXTENSION);
        
              $TITLE = $post_info_result['Title'];
              $P_DATE = $post_info_result['Publish_Date'];
              $Creator_ID = $post_info_result['Creator_ID'];
                                        
              echo "<div class='box-container'>
                      <div class='box_head'>
                        <img src='data:image/".$text.";base64,".$img."'/>
                                
                          <div class='tag'>
                            <div class='tag_text'>".$Type."</div>
                          </div>
                                          
                          <div class='middle'>
                            <div class='view_btn'>
                            <ul>
                               <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                            </ul>
                          </div>
                                              
                        </div>
                      </div>
                                        
                      <div class='box_body'>";
                        
                        include './Last_Read.php';  
                       
                        echo "<h3>".$TITLE."</h3>";
                        echo "<p>".$P_DATE."</p>";
                        echo "<b><i>-</b></i>";
                        echo "<i> All Areas- ";
                        echo "</i>";
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
                                      <li onclick=toggle_save('$Post_ID','ARTICLES');><a href='#'>Save</a></li>
                                      <li onclick=toggle_hidden('$Post_ID','ARTICLES');><a href='#'>Hide</a></li>";
                                      if($_SESSION['Actor_Type'] == "ADMIN"){
                                        //First call toggle_delete function in this file
                                      echo "<li onclick=toggle_delete('$Post_ID','ARTICLES');><a href='#'>Delete</a></li>";
                                      }
                                    echo"</ul>
                            </div>
                          </div>";
        
          }
          
        }
      }
      
                
                                    
  ?>

         
          
    </div>

    
</div>

<?php

//third step

if(isset($_POST['delete_articles_post_id'])){

  $Post_ID = $_POST['delete_articles_post_id'];

  //If anyone save this articles
  $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
  $statement1 = $conn->prepare($sql1);
  $statement1->bindParam(':Post_ID', $Post_ID);
  $statement1->execute();

  //If anyone hidden this articles
  $sql2 = "DELETE FROM hidden WHERE Post_ID = :Post_ID";
  $statement2 = $conn->prepare($sql2);
  $statement2->bindParam(':Post_ID', $Post_ID);
  $statement2->execute();

  //remove read time of the articles
  $sql3 = "DELETE FROM read_time WHERE Post_ID = :Post_ID";
  $statement3 = $conn->prepare($sql3);
  $statement3->bindParam(':Post_ID', $Post_ID);
  $statement3->execute();

  //remove articles from main table
  $sql4 = "DELETE FROM articles WHERE Post_ID = :Post_ID";
  $statement4 = $conn->prepare($sql4);
  $statement4->bindParam(':Post_ID', $Post_ID);
  $statement4->execute();

}

?>


<script>

    //sencond step
    // After call php function in this file (above) if(delete_articles_post_id) function
    function toggle_delete(delete_articles_post_id,Type){
        $.ajax({
          url : './Moderator_View_Articles.php',
          type: "POST",
          data :{delete_articles_post_id:delete_articles_post_id,
            Type:Type},
          success:function(data){
            window.open("./Moderator_View_Articles.php","_self");
          }
        })
    }

    function toggle_save(save_post_id,Type){
      $.ajax({
        url : '../Control/post_control.php',
        type: "POST",
        data :{save_post_id:save_post_id,
          Type:Type},
        success:function(data){
          window.open("./Moderator_View_Articles.php","_self");
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
          window.open("./Moderator_View_Articles.php","_self");
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
          //console.log(view_post_id);
          window.open("./Moderator_View_Post_Read.php","_self");
        }
      })
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
    
</body>
</html>