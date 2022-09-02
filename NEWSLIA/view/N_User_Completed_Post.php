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
  <?php $page = 'more';
  include 'nav.php'; ?>
  <!--End of Navigation-Bar-->


  <div class="content_posts_view">
    <div class="posts_content_view_head" style="font-size: x-large;">
      Completed Posts
    </div>

    
  </div>

  <div class="posts_content_view_body">
    <div class="body_information">

    <?php
      include '../Model/connect.php';
      $USERID = $_SESSION['System_Actor_ID'];
      $Type = $_SESSION['Actor_Type'];

      if($Type == "REPORTER"){
        $table = 'News';
        $post_info_sql = "SELECT * FROM news WHERE Creator_ID = '$USERID'  ORDER BY Publish_Date DESC";                        
        $post_info_state = $conn->query($post_info_sql);
        $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
       
        if($post_info_results){
          foreach($post_info_results as $post_info_result){
  
            $Post_ID = $post_info_result['Post_ID'];
  
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
                                <div class='view_btn'>
                                  <ul>
                                    <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>";        
          }
        }
      }


      else{
      $table = 'Articles';
      $post_info_sql = "SELECT * FROM articles WHERE Creator_ID = '$USERID'  ORDER BY Publish_Date DESC";                        
      $post_info_state = $conn->query($post_info_sql);
      $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
     
      if($post_info_results){
        foreach($post_info_results as $post_info_result){

          $Post_ID = $post_info_result['Post_ID'];

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
                              <div class='view_btn'>
                                <ul>
                                  <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>";        
        }
      }
    }

    

      //print CA

      $table = 'Ads';
      $post_info_sql = "SELECT * FROM com_ads WHERE Creator_ID = '$USERID' ORDER BY Publish_Date DESC";                        
      $post_info_state = $conn->query($post_info_sql);
      $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
     
      if($post_info_results){
        foreach($post_info_results as $post_info_result){

          $Post_ID = $post_info_result['Post_ID'];

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
                              <div class='view_btn'>
                                <ul>
                                  <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>";        
        }
      }


      //print JV

      $table = 'Vacancies';
      $post_info_sql = "SELECT * FROM job_vacancies WHERE Creator_ID = '$USERID' ORDER BY Publish_Date DESC";                        
      $post_info_state = $conn->query($post_info_sql);
      $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
     
      if($post_info_results){
        foreach($post_info_results as $post_info_result){

          $Post_ID = $post_info_result['Post_ID'];

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
                              <div class='view_btn'>
                                <ul>
                                  <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>";        
        }
      }


      // print notices

      $table = 'Notices';
      $post_info_sql = "SELECT * FROM notices WHERE Creator_ID = '$USERID' ORDER BY Publish_Date DESC";                        
      $post_info_state = $conn->query($post_info_sql);
      $post_info_results = $post_info_state->fetchAll(PDO::FETCH_ASSOC);
     
      if($post_info_results){
        foreach($post_info_results as $post_info_result){

          $Post_ID = $post_info_result['Post_ID'];

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
                              <div class='view_btn'>
                                <ul>
                                  <li onclick=toggle_view('$Post_ID','ARTICLES');><a href='#'>View</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>";        
        }
      }
                                                          
  ?>

    </div>
  </div>

</body>

<script>
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



</script>


</html>