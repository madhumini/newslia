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
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
</head>

<style>
  body {
    /*overflow-x: hidden; /* Hide scrollbars */
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

  .card{
    cursor: pointer;
    transition:0.5s ease;
  }

  .card:hover{
    transform:scale(1.2);
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

.back_btn{
    margin-top:23.2rem;
    background-color:#ADD8E6;
    margin-left:-4rem;
    color:#222;
    width:100px;
   
  }


  .button-set{
    margin-top:1rem;
    margin-left:74rem;
    position:fixed;
  }



</style>

<body>

 
<!--navigation-->

<?php $page = 'home';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->

<!-- Moderator Notices View -->



<?php

        include '../Model/connect.php';
        $USER_ID = $_SESSION['INSIGHT_MODERATOR_ID'];
            
        $moderator_details_sql = "SELECT * FROM moderate_insights WHERE (System_Actor_Id = '$USER_ID')";
        
        $moderator_details_statement = $conn -> query($moderator_details_sql);
        $moderator_details_results = $moderator_details_statement->fetchAll(PDO::FETCH_ASSOC);
        $news = $notice = $articles = $Job_Vacancies = $Commercial_Ads = $Complaints = 0;

        if($moderator_details_results){
          foreach($moderator_details_results as $moderator_details_result){

            $news = $moderator_details_result['News'];
            $articles = $moderator_details_result['Articles'];
            $notice = $moderator_details_result['Notices']; 
            $Job_Vacancies = $moderator_details_result['Job Vacancies']; 
            $Commercial_Ads = $moderator_details_result['Commercial Ads'];
            $Complaints = $moderator_details_result['Complaints'];
            
          }
        }
        $total = $news + $articles + $notice + $Job_Vacancies + $Commercial_Ads;

        $persentage = 0;

        if($total != 0){
          $persentage = (($total - $Complaints)/$total)*100; 
        }

echo "
    <div class='right_side' style='margin-top:15rem;margin-left:10rem;'>
      <div class='bottom_side'>

          <div class='approvement'>

            
            <div class='card'>
        
                    <div class='content'>
                      <h2>".$total."<br/><span>Approves</span></h2>
                    </div>
                    <ul class='navigation'>
                      <li>
                        <p>News <span>".$news."</span> </p>
                      </li>
                      <li>
                        <p>Articles <span>".$articles."</span> </p>
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

          </div>";
          
          
         
          echo "<div class='trust'>
                  <div class='card card3'>
                          <div class='content'>
                            <h2><span class='precentage' style='color:#000;font-size:1.5rem'><b>";
                              if($total == 0){
                                echo "0";
                              }else{
                                echo round($persentage,2);
                              }
                            
                            echo "%</b></span><br/> <span class='precentage'>Trust for Approvement</span></h2>";
                           

                            echo"<br>
                            
                          </div>
                        
                  </div>

          </div>";
          

          
    echo "</div>

</div>

";
?>


<div class='button-set'>
                    <div class='view_btn back_btn' onclick="window.open('Moderator_Reporter.php','_self')">Back</div>
                </div>

                <?php
        
        $moderator_profile_sql = "SELECT * FROM system_actor WHERE (System_Actor_Id = '$USER_ID')";
        $moderator_profile_statement = $conn -> query($moderator_profile_sql);
        $moderator_profile_results = $moderator_profile_statement->fetchAll(PDO::FETCH_ASSOC);
        

        if($moderator_profile_results){
          foreach($moderator_profile_results as $moderator_profile_result){
              $first = $moderator_profile_result['FirstName'];
              $last = $moderator_profile_result['LastName'];

              $img = $moderator_profile_result['Profile_Img'];
              $img = base64_encode($img);
              $text = pathinfo($moderator_profile_result['System_Actor_Id'], PATHINFO_EXTENSION);
          }
        }

echo "
<div class='top_side' style='margin-top:1rem;'>";

        if($img != NULL){
            echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(0.7);margin-top:-3rem;border-radius:10%;'>";
          }
        else{
            echo "<img src='../images/Profile.svg' style='transform:scale(2);margin-bottom:3rem;'>";
          }
      
        echo  "<p style='margin-top:-3rem;'>".$first." ".$last."</p>";
      
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