<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator_Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
   
</head>

<body>



<!--navigation-->

<?php $page = 'home';
  include '../view/nav.php'; ?>

<!--End of Navigation-Bar-->


        <div class="errorbox" id="error1">
        <div class="content_erro">
            <div class="error_head">NEWSLIA says</div>
            <div class="error_body">Password is not matched</div>
            <div class="error_foot" onclick="pwd_error_remove()">OK</div>

        </div>
        </div>
        
        <script>
            function pwd_error_add(){
             document.getElementById("error1").classList.add("active");
            }

            function pwd_error_remove(){
             document.getElementById("error1").classList.remove("active");
             window.open('../view/Moderator_Profile.php','_self');
            }
        </script>
</body>   

<?php
include '../Model/connect.php'; 
    if(isset($_POST['deactivate'])){
        
        $confirm_deactivate = $_POST['confirm_deactivate'];
        $System_Actor_ID = $_SESSION['System_Actor_ID'];

        $pwd_check_sql = "SELECT * FROM login WHERE (System_Actor_ID = '$System_Actor_ID') ";
        $pwd_check_statement = $conn -> query($pwd_check_sql);
        $pwd_check_results = $pwd_check_statement->fetchAll(PDO::FETCH_ASSOC);

        if ($pwd_check_results){
            foreach($pwd_check_results as $pwd_check_result){
                if($pwd_check_result['Password'] == md5($confirm_deactivate)){
                  
                    $stmt_deactive = $conn->prepare("INSERT INTO `deactivate` VALUES(?,?)");
                    $stmt_deactive->execute([$System_Actor_ID, date('Y-m-d', strtotime(date('Y-m-d'). ' + 15 days'))]);

                   
                    $DEACTIVE = [
                        'System_Actor_ID' => $System_Actor_ID,
                        'Deactivate' => 1
                    ];
                    
                    $sql_update_deactivate = 'UPDATE login
                            SET Deactivate = :Deactivate
                            WHERE System_Actor_ID = :System_Actor_ID';
                    
                    // prepare statement
                    $statement_update_deactivate = $conn->prepare($sql_update_deactivate);
                    
                    // bind params
                    $statement_update_deactivate->bindParam(':System_Actor_ID', $DEACTIVE['System_Actor_ID']);
                    $statement_update_deactivate->bindParam(':Deactivate', $DEACTIVE['Deactivate']);
                    
                    // execute the UPDATE statment
                    $statement_update_deactivate->execute();

                    echo "<script> window.open('../view/index.php','_self'); </script>";

                }
                else {
                    echo '<script type="text/javascript">pwd_error_add();</script>';
                   
                }
            }
        }

    }
?>