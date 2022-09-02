<?php
    session_start();
    
    include '../Model/connect.php'; 
//update post

    if(isset($_POST['PENDING_POST_ID']) ){

        $_SESSION['G_PENDING_POST_ID'] = $_POST['PENDING_POST_ID'];
                                         
    }

// delete post

    if(isset($_POST['DELETE_POST_ID']) and isset($_POST['DELETE_POST_TYPE'])){

        $_SESSION['G_DELETE_POST_ID'] = $_POST['DELETE_POST_ID'];
        $_SESSION['G_DELETE_POST_TYPE'] = $_POST['DELETE_POST_TYPE'];
        
                                   
    }
    
    

?>