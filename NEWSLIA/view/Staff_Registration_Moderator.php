<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator_Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/insight.css">
    <link rel="stylesheet" href="../css/System Staff Registration Confirm.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
</head>
<body>

 
  <style>
  
  .card{
    transition:0.5s ease;
  }
  .card:hover{
    transform:scale(1.2);
  }

  </style>

<!--navigation-->

<?php $page = 'view';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!-- Moderator Notices View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Moderators
    </div>

     
</div>


<div class="reporter_insight">

        <?php
          include '../model/connect.php';
          
          $staff_state_sql = "SELECT * FROM login WHERE Staff_State = '0'";
          $staff_state_statement = $conn -> query($staff_state_sql);
          $staff_state_results = $staff_state_statement->fetchAll(PDO::FETCH_ASSOC);
        
          if($staff_state_results){
              foreach($staff_state_results as $staff_state_result){

                $ID = $staff_state_result['System_Actor_ID'];
                $email = $staff_state_result['Email'];

                $staff_state_actor_sql = "SELECT * FROM system_actor WHERE System_Actor_Id = '$ID' AND 	Position = 'M'";
                $staff_state_actor_statement = $conn -> query($staff_state_actor_sql);
                $staff_state_actor_results = $staff_state_actor_statement->fetchAll(PDO::FETCH_ASSOC);

                if($staff_state_actor_results){
                  foreach($staff_state_actor_results as $staff_state_actor_result){

                            $img = $staff_state_actor_result['Profile_Img'];
                            $img = base64_encode($img);
                            $text = pathinfo($staff_state_actor_result['System_Actor_Id'], PATHINFO_EXTENSION);
                            
                            echo "
                            <form action = './Staff_Registration_Moderator.php' method = 'POST'>
                                <input type='hidden' name='staffId' value='".$staff_state_actor_result['System_Actor_Id']."'>
                                <input type='hidden' name='staffemail' value='".$email."'>
                            <button class='card' name='moderator'>
                            <div class='content'>
                              <div class='imgBx'>";
                                if($img != NULL){
                                  echo "<img src='data:image/".$text.";base64,".$img."'/ style='transform:scale(1);'>";
                                }
                                else{
                                  echo "<img src='../images/Profile.svg' style='transform:scale(1);'>";
                                }
                              echo "</div>
                              <h2>".$staff_state_actor_result['FirstName'].""."  "."".$staff_state_actor_result['LastName']."</h2>
                            </div>
                            </button> 
                            </form>";
                  }
                }
                
              }
          }

           
        
        ?>


</div>


<?php
  if(isset($_POST['moderator'])){

    $_SESSION['STAFF_MEMBER'] = $_POST['staffId'];
    
    $_SESSION['STAFF_MEMBER_EMAIL'] = $_POST['staffemail'];

    //$ID = $_SESSION['STAFF_MEMBER'];

    //echo '<script>alert(work)</script>';
    //echo '<script>alert("'.$ID.'")</script>';
    echo '<script type="text/javascript">window.open("./System Staff Registration Confirm.php", "_self");</script>';
  }
?>




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

</script>
  
</body>
</html>