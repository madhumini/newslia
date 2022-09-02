<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>NEWSLIA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico">
    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<style>
    body {
        font-family: 'Sora', sans-serif;
    }

    .profile-menu-container {
        margin-right: 160px;
    }

    .down {
        margin-left: 2px;
    }

    .fa-customize {
        font-size: 22px;
        color: black;
    }

    .input-field {
        background-color: #eeeeee;
        padding: 8px;
        border: none;
        outline: none;
        font-size: 15px;
        padding-left: 20px;
        width: 80%;
    }

    .write-article-btn {
        padding: 8px;
        width: 150px;
        border: none;
        outline: none;
        border-radius: 7px;
        cursor: pointer;
        margin-left: 20px;
        font-size: 18px;
        transition: .5s ease;

    }

    .write-article-btn :hover {
        transform: scale(1.2);
    }
</style>

<body>
    <!--navigation-->

    <?php $page = 'articles';
    include 'nav.php'; ?>

    <!--End of Navigation-Bar-->

    <?php
    $post_Id = $_SESSION['G_PENDING_POST_ID'];
    $type = "P_A";

    $variable_1 = "SELECT *FROM articles_pending WHERE Post_ID = '$post_Id' AND NormalUser_Can_Edit = '1'";
    $variable_2 = $conn->query($variable_1);
    $variable_3 = $variable_2->fetchAll(PDO::FETCH_ASSOC);

    if ($variable_3) {
        foreach ($variable_3 as $variable_4) {
            $title = $variable_4['Title'];
            $content = $variable_4['Details'];

            echo "
        
        <div style='margin-top: 40px; margin-left: 40px;'>
        <form action='N_User_Pending_Posts.php' method='post' enctype='multipart/form-data'>
            <div style='display: flex; justify-content: space-between; margin-top: 15px;'>
                <div style='width: 15%;'>
                    <h3> Title :- </h3>
                </div>
                <div style='width: 85%;'>
                    <input type='text' name='Title' class='input-field' value='$title' required> 
                </div>
            </div>



            <div style='display: flex; justify-content: space-between; margin-top: 15px;'>
                <div style='width: 15%;'>
                    <h3>Content :-</h3>
                </div>
                <div style='width: 85%;'>
                    <div class='container'>
                        <div style='width: 95%;'>
                            <textarea class='ckeditor' name='Content'  required>
                                
                                 $content 
                                
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div style='display: flex; justify-content: space-between; margin-top: 15px;'>
                <div style='width: 15%;'>
                    <h3>Add Images :-</h3>
                </div>
                <div style='width: 85%;'>
                    <div class='input-field'>
                        <input type='file' name='Image' required>
                    </div>
                </div>
            </div>


            <div style=' margin-bottom: 150px; margin-top: 60px; text-align: end; margin-right: 50px; display: flex; justify-content: flex-end;'>
                <input type='submit' value='Draft' class='write-article-btn' style='background-color: #45ADA8EB;' name='Draft_Pending_Article' >
                <input type='submit' value='Save' class='write-article-btn' style='background-color: #00B172EB;' name='P_A_EDIT_submit' >
                <div class='write-article-btn' style=' background-color: #FF4444EB; text-align: center;' onclick=togglePopup_select_option('confirm_delete');>Delete</div>
            </div>

        </form>
    </div>

    



    <div class='navigation-popup  navigation-popup_set_time' id='confirm_delete'>
    <div class='navigation-overlay'></div>
      <div class='navigation-content  navigation-popup_set_time' style='width: 300px; height: 280px;'>
        <div class='navigation-content_body  navigation-popup_set_time_body'>
          <div class='navigation-popup_logo'>
          <img src='../images/Name.svg'>
          </div>
          
          <hr>

          <div class='navigation-popup_form'>
            <h3 class='navigation-popup_title' style='text-align: center;'>Sure to Delete</h3>
            <div class='navigation-btn_set_option'>

           

              <div class='navigation-select_option' onclick=toggle_delete('$post_Id','$type'); style='text-align: center; font-weight: bold; background-color: #FF4444EB;'>Yes</div>
              <div class='navigation-select_option' onclick=togglePopup_select_option('confirm_delete'); style='text-align: center; font-weight: bold;'>No</div>

            </div>
          </div>
        </div>
      </div>
  </div>  

        ";
        }
    }


    ?>



</body>

<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

<script>
    function toggle_delete(DELETE_POST_ID, DELETE_POST_TYPE) {
        $.ajax({
            url: "../Control/N_User_Post_Handle.php",
            type: "POST",
            data: {
                DELETE_POST_ID: DELETE_POST_ID,
                DELETE_POST_TYPE: DELETE_POST_TYPE,
            },
            success: function(data) {
                window.open('./N_User_Delete_Post.php', '_self');
            }
        });
    }
</script>



</html>