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
    <link rel="stylesheet" href="../css/insight.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    height: 240px;
  }

  .posts_content_view_head{
    font-size:x-large;

  }

  .card{
    transition:0.5s ease;
  }
  .card:hover{
    transform:scale(1.2);
  }

  .imgBx{
    border:1px solid #333;
  }

</style>

<body>


<!--navigation-->

<?php $page = 'insights';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Reporters' Insights
    </div>

      
     
    
    
</div>



<div class="reporter_insight">
    
    <?php

    include '../Model/connect.php';
    
    if($_SESSION['Actor_Type'] != "ADMIN"){
        $Moderator_Area = $_SESSION['moderate_area'];
        $reporters_in_area_sql = "SELECT * FROM report_area WHERE (Area = '$Moderator_Area')";
    }
    else{
        $reporters_in_area_sql = "SELECT DISTINCT System_Actor_Id FROM report_area";
    }

    $reporters_in_area_statement = $conn -> query($reporters_in_area_sql);
    $reporters_in_area_results = $reporters_in_area_statement->fetchAll(PDO::FETCH_ASSOC);

    if($reporters_in_area_results){
        foreach($reporters_in_area_results as $reporters_in_area_result){

            $Reporters_In_Area = $reporters_in_area_result['System_Actor_Id'];

            $reporters_details_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$Reporters_In_Area')";
            $reporters_details_statement = $conn -> query($reporters_details_sql);
            $reporters_details_results = $reporters_details_statement->fetchAll(PDO::FETCH_ASSOC);

            if($reporters_details_results){
              foreach($reporters_details_results as $reporters_details_result){

                    $img = $reporters_details_result['Profile_Img'];
                    $img = base64_encode($img);
                    $text = pathinfo($reporters_details_result['System_Actor_Id'], PATHINFO_EXTENSION);

                    $first = $reporters_details_result['FirstName'];
                    $last = $reporters_details_result['LastName'];

                    echo "
                      <div class='card'>

                            <div class='content'>
                              <div class='imgBx'>";

                                if($img != NULL){
                                  echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(1);'>";
                                }
                                else{
                                  echo "<img src='../images/Profile.svg' style='transform:scale(1);'>";
                                }
      
                    echo  " </div>
                              <h2 onclick=toggle_view_insight('$Reporters_In_Area','$first','$last');>".$first." ".$last."</h2>
                              </div>
                          </div>
                        ";
              }
            }
            
        }
    }
?>
            
</div>
<!--
  
  -->                  
<script>
    
    function toggle_view_insight(REPORTER_Insight_ID,FIRST,LAST){
      $.ajax({
        url :"../Control/save_hidden.php",
        type:"POST",
        cache:false,
        data:{REPORTER_Insight_ID:REPORTER_Insight_ID,
              FIRST:FIRST,
              LAST:LAST},
        success:function(data){
          window.open('./Moderator_Reporter_Insights.php','_self');
        }

      });
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