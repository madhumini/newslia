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
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  
 
  .box-container{
    margin-left:1rem;
  }

  .box_head img{
    height:50%;
  }

  .more{
      font-size:14px;
      text-align:right;
      margin-top:-9%;
      display:flex;
      flex-direction:row;
      
  }
  .more p{
    margin-left:5%;
  }

  .box_head:hover img{
    opacity: 1;
  }

  .setting_close{
    transform:scale(1.2);
    margin-left:87%;
    margin-top :-12%;
  }
  .setting_close img{
    transition: 0.25s ease;
    cursor: pointer;
  }
  .setting_close img:hover{
    transform:scale(1.2);
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

<?php $page = 'publish';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->
 


<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Pending Posts
    </div>

      <div class="post_sort">
        <div class="post_sort_bar">
          <button onclick="showsort()" class="drop_area_sort">Select Post Type<img src="../images/sort.svg" alt="" srcset=""></button>
          <div class="drop_area_sort_cont" id="sortdrop">
            <img src="../images/search.svg" alt="" srcset="">
            <input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Search...">
            
          </div>
        </div>
      </div>
      
     
    
</div>

<div class="content_posts_view">

    <div class="posts_content_view_head" id="content_sort">
         
        <?php
            include './Moderator_Peding_Content.php';
        ?>
          
    </div>
</div>

<script>
    function showsort() {
      document.getElementById("sortdrop").classList.toggle("show");
    }


    function toggle_view_News(View_News_ID){
      $.ajax({
        url:"../Control/Pending_SetTime.php",
        type:"post",
        data:{
          View_News_ID : View_News_ID
        },
        success:function(data){
          window.open('./Moderator_Check_News.php','_self');
        }
      });
    }

    function toggle_view_Articles(View_Article_ID){
      $.ajax({
        url:"../Control/Pending_SetTime.php",
        type:"post",
        data:{
          View_Article_ID : View_Article_ID
        },
        success:function(data){
          window.open('./Moderator_Check_Articles.php','_self');
        }
      });
    }

    function toggle_view_Ads(View_Ads_ID,Type){
      $.ajax({
        url:"../Control/Pending_SetTime.php",
        type:"post",
        data:{
          View_Ads_ID : View_Ads_ID,
          Type : Type
        },
        success:function(data){
          
          window.open('./Moderator_Check_Ads.php','_self');
        }
      });
    };

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
    
</body>
</html>