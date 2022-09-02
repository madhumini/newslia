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
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>

  body{
    overflow:scroll;
  }
  
  
  .post_sort{
      padding-left:80px;
  }
  .box-container{
    height: 240px;
  }

  .posts_content_view_head{
    font-size:xx-large;

  }

  .right_side{
    margin-left:3rem;
    border-top:1px solid #333;
    width:95%;
    margin-top:15%;
  }

  .top_side{
    margin-top:-0%;
  }

  .card{
    transition:0.5s ease;
    cursor: pointer;
  }

  .card:hover{
    transform:scale(1.2);
  }

  .card.active {
	height: 260px;
}

.card{
    margin-left: -4rem;
}

.card2{
    margin-left: -6rem;
}

.card3{
  margin-left: 2rem;
}

.card4{
  margin-left:2rem;
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

  .button-set{
    margin-top:1rem;
    margin-left:74rem;
    position:fixed;
  }

  .view_btn{
    width:100px;
    height:20px;
    margin-top:20%;
    margin-left:15rem;
    margin-right:5rem;
    box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.4);
    transition: 0.5s ease;
    float:right;
    
  }

  .view_btn:hover{
    transform:scale(1.2);
  }

  .back_btn{
    margin-top:10.2rem;
    background-color:#ADD8E6;
    margin-left:-4rem;
    color:#222;
   
  }

</style>

<body>



<!--navigation-->

<?php $page = 'insights';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!-- Moderator Notices View -->

<!--

<div class="left_side">

  <div class="icon_left_side">

  <li><a href="#"> <img src="../images/other/profile.png" alt="" srcset=""><p>My Profile</p></a></li>
  <li><a href="#"><img src="../images/other/location.png" alt="" srcset=""><p>Select Area</p></a></li>
  <li><a href="#"><img src="../images/other/type.png" alt="" srcset=""><p>Select Type</p></a></li>
  <li><a href="#"><img src="../images/other/insights.png" alt="" srcset=""><p>Insights</p></a></li>
  <li><a href="#"><img src="../images/other/deactivate.png" alt="" srcset=""><p>Deactivate</p></a></li>
  <li><a href="#"><img src="../images/other/logout.png" alt="" srcset=""><p>Log Out</p></a></li>



  </div>

</div>
-->



<?php

    include '../Model/connect.php';
    $Reporters_In_Area = $_SESSION['INSIGHT_REPORTER_ID'];

    $reporters_details_sql = "SELECT * FROM reporter_insights WHERE (System_Actor_Id = '$Reporters_In_Area')";
    $reporters_details_statement = $conn -> query($reporters_details_sql);
    $reporters_details_results = $reporters_details_statement->fetchAll(PDO::FETCH_ASSOC);
    $news = $notice = $Job_Vacancies = $Commercial_Ads = $Complaints = $Stars = 0;

    if($reporters_details_results){
      foreach($reporters_details_results as $reporters_details_result){

        $news = $reporters_details_result['News'];
        $notice = $reporters_details_result['Notices']; 
        $Job_Vacancies = $reporters_details_result['Job Vacancies']; 
        $Commercial_Ads = $reporters_details_result['Commercial Ads'];

        $Complaints = $reporters_details_result['Complaints'];
        $Stars = $reporters_details_result['Stars'];
      }
    }
    $total = $news + $notice + $Job_Vacancies + $Commercial_Ads;
    
    $persentage = 0;

    if($total != 0 && $news != 0){
      $persentage = (($news - $Complaints)/$news)*100; 
    }
    

echo "<div class='right_side'>

    
    <div class='bottom_side'>

          <div class='approvement'>

            <div class='card'>
                    <div class='content'>
                      <h2>".$total."<br/><span>Published</span></h2>
                    </div>
                    <ul class='navigation'>
                      <li>
                        <p>News <span>".$news."</span> </p>
                      </li>
                    
                      <li>
                        <p>Notices <span>".$notice."</span></p>
                      </li>
                      <li>
                        <p>Job Vacancies <span>".$Job_Vacancies."</span></p>
                      </li>
                      <li>
                        <p>Commercial Ads <span>".$Commercial_Ads."</span></p>
                      </li>
                    </ul>
                    <div class='toggle'>
                      <i class='fa fa-chevron-down'></i>
                    </div>
            </div>


          </div>

          <div class='complaints'>

                <div class='card card2'>
                          <div class='content'>
                            <h2>".$Complaints."<br/><span>Complaints</span></h2>
                          </div>
                        
                  </div>

          </div>

          <div class='trust'>
                  <div class='card card3'>
                          <div class='content'>
                            <h2>
                            <span class='precentage' style='color:#000;font-size:1.5rem;margin-left:-0.5rem;'><b>";
                              
                              if($total == 0){
                                echo "0";
                              }else{
                                echo round($persentage,2);
                              }
                            
                            echo "%</b></span>
                            <br/> 
                            <span class='precentage' style='padding-left:1.5rem;'>Trust for Publish</span></h2>
                            <br>
                          </div>
                  </div>
          </div>



          <div class='star'>
                  <div class='card card4'>
                          <div class='content'>

                            <h2><span class='precentage' style='color:#000;font-size:1.5rem;margin-left:0.5rem;'>";
                            $i=0;

                            if($Stars==0){
                              echo "<b>-</b>";
                            }
                            while($i<$Stars){
                              echo "<b><img src='../images/black_star.svg'></b></span>";
                              $i++;
                            }
                            

                            echo"
                            <br>
                            <span class='precentage' style='margin-left:0.5rem;'>
                            Black Stars</span></h2>

                            <br>
                            
                          </div>
                        
                  </div>

          </div>
    </div>
";


?>
                <div class='button-set'>
                    <div class='view_btn back_btn' onclick="window.open('Moderator_Reporter.php','_self')">Back</div>
                </div>


<?php
    include '../Model/connect.php';
    $Reporters_In_Area = $_SESSION['INSIGHT_REPORTER_ID'];

    $reporters_details_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$Reporters_In_Area')";
    $reporters_details_statement = $conn -> query($reporters_details_sql);
    $reporters_details_results = $reporters_details_statement->fetchAll(PDO::FETCH_ASSOC);

    if($reporters_details_results){
      foreach($reporters_details_results as $reporters_details_result){

        $img = $reporters_details_result['Profile_Img'];
        $img = base64_encode($img);
        $text = pathinfo($reporters_details_result['System_Actor_Id'], PATHINFO_EXTENSION);
      }
    }

echo "</div>
<div class='top_side'>";

    if($img != NULL){
      echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(0.5);margin-top:-7rem;border-radius:10%;'>";
    }
    else{
      echo "<img src='../images/Profile.svg' style='transform:scale(2);margin-bottom:5rem;'>";
    }
    
    echo "<p style='margin-top:-5.5rem;'>".$_SESSION['INSIGHT_REPORTER_FIRST']." ".$_SESSION['INSIGHT_REPORTER_LAST']."</p>";

echo "</div>";

?>


<script>
    const card = document.querySelector(".card");
    const cardToggle = document.querySelector(".toggle");

    cardToggle.onclick = () => {
	      card.classList.toggle("active");
    };
</script>
    
</body>
</html>