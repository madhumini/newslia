<?php
    session_start();
    date_default_timezone_set("Asia/Calcutta");
    
    include '../Model/connect.php'; 

    if(isset($_POST['View_News_ID'])){

        $_SESSION['SAVE_READ_Post_News_ID'] = $_POST['View_News_ID'];
                                   
    }

    if(isset($_POST['View_Article_ID'])){

        $_SESSION['SAVE_READ_Post_Article_ID'] = $_POST['View_Article_ID'];
                                   
    }

    if(isset($_POST['View_Ads_ID'])){

        $_SESSION['SAVE_READ_Post_Ads_ID'] = $_POST['View_Ads_ID'];
        $_SESSION['Ads_Type'] = $_POST['Type'];
                                   
    }



    if(isset($_POST['Delete_ID'])){
        $ID = $_POST['Delete_ID'];
        $Type = $_POST['Type'];
       
        $System_Date = date("Y-m-d");
        $System_Time = date("H:i:s");

        $POSTS = [
            'Post_ID' => $ID,
            'Publish_Date' => $System_Date,
            'Set_Date' => $System_Date,
            'Set_Time' => $System_Time
        ];

        if($Type == 'Notices'){
            $query = 'UPDATE notices SET Publish_Date = :Publish_Date, Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        elseif($Type == 'Vacancies'){
            $query = 'UPDATE job_vacancies SET Publish_Date = :Publish_Date, Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        else{
            $query = 'UPDATE com_ads SET Publish_Date = :Publish_Date, Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }

        $statement = $conn -> prepare($query);
        
        $statement->bindParam(':Publish_Date', $POSTS['Publish_Date']);
        $statement->bindParam(':Set_Date', $POSTS['Set_Date']);
        $statement->bindParam(':Set_Time', $POSTS['Set_Time']); 
        $statement->bindParam(':Post_ID', $POSTS['Post_ID']);

        if ($statement->execute()) {
            echo "<script>window.open('../view/Moderator_Set_Time.php','_self');</script>";
        }

    }



    if(isset($_POST['Update_Set_Time'])){

        $ID = $_POST['ID'];
        $Type = $_POST['Type'];
       
        $System_Date = $_POST['update_set_time_date'];
        $System_Time = $_POST['update_set_time_time'];

        $POSTS = [
            'Post_ID' => $ID,
            'Set_Date' => $System_Date,
            'Set_Time' => $System_Time
        ];

        if($Type == 'Notices'){
            $query = 'UPDATE notices SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        elseif($Type == 'Vacancies'){
            $query = 'UPDATE job_vacancies SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        else{
            $query = 'UPDATE com_ads SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }

        $statement = $conn -> prepare($query);
        
        $statement->bindParam(':Set_Date', $POSTS['Set_Date']);
        $statement->bindParam(':Set_Time', $POSTS['Set_Time']); 
        $statement->bindParam(':Post_ID', $POSTS['Post_ID']);

        if ($statement->execute()) {
            echo "<script>window.open('../view/Moderator_Set_Time.php','_self');</script>";
        }

    }


    if(isset($_POST['View_ID']) and isset($_POST['Type'])){

        $_SESSION['SET_TIME_READ_Post_ID'] = $_POST['View_ID'];
        $_SESSION['SET_TIME_READ_TYPE'] = $_POST['Type'];
                                   
    }


    if(isset($_POST['Update_Set_Time_Read'])){
        $ID = $_POST['ID'];
        $Type = $_POST['Type'];
       
        $System_Date = $_POST['update_set_time_date'];
        $System_Time = $_POST['update_set_time_time'];

        $POSTS = [
            'Post_ID' => $ID,
            'Set_Date' => $System_Date,
            'Set_Time' => $System_Time
        ];

        if($Type == 'Notices'){
            $query = 'UPDATE notices SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        elseif($Type == 'Vacancies'){
            $query = 'UPDATE job_vacancies SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }
        else{
            $query = 'UPDATE com_ads SET Set_Date = :Set_Date, Set_Time = :Set_Time WHERE Post_ID = :Post_ID';
        }

        $statement = $conn -> prepare($query);
        
        $statement->bindParam(':Set_Date', $POSTS['Set_Date']);
        $statement->bindParam(':Set_Time', $POSTS['Set_Time']); 
        $statement->bindParam(':Post_ID', $POSTS['Post_ID']);

        if ($statement->execute()) {
            echo "<script>window.open('../view/Moderator_Set_Time_Read.php','_self');</script>";
        }
    }

    
?>