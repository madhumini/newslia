<?php
    session_start();
    
    include '../Model/connect.php'; 
    if(isset($_POST['SAVE_ID'])){

        $ID = $_POST['SAVE_ID'];
        $System_Actor_ID = $_SESSION['System_Actor_ID'];

        $query = "DELETE FROM save WHERE Post_ID = :ID AND System_Actor_ID = :SA_ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        $query_statement->bindParam(':SA_ID',$System_Actor_ID,PDO::PARAM_STR);
        if ($query_statement->execute()) {
            echo "<script>window.open('../view/Moderator_save.php','_self');</script>";
        }    
                              
    }


    if(isset($_POST['HIDDEN_ID']) and isset($_POST['TYPE'])){

        $ID = $_POST['HIDDEN_ID'];
        $TYPE = $_POST['TYPE'];
        $System_Actor_ID = $_SESSION['System_Actor_ID'];

        $stmt_num = $conn->prepare("INSERT INTO `hidden` VALUES(?,?,?)");
        $stmt_num->execute([$ID,$System_Actor_ID,$TYPE]);
                                    
    }


    if(isset($_POST['VIEW_ID']) and isset($_POST['TYPE'])){

        $_SESSION['SAVE_READ_Post_ID'] = $_POST['VIEW_ID'];
        $_SESSION['SAVE_READ_TYPE'] = $_POST['TYPE'];
                                   
    }


    if(isset($_POST['REMOVE_HIDDEN_ID'])){

        $ID = $_POST['REMOVE_HIDDEN_ID'];
        $System_Actor_ID = $_SESSION['System_Actor_ID'];

        $query = "DELETE FROM hidden WHERE Post_ID = :ID AND System_Actor_ID = :SA_ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        $query_statement->bindParam(':SA_ID',$System_Actor_ID,PDO::PARAM_STR);
        if ($query_statement->execute()) {
            echo "<script>window.open('../view/Moderator_Hidden.php','_self');</script>";
        }                              
    }


    if(isset($_POST['REPORTER_Insight_ID'])){
        $_SESSION['INSIGHT_REPORTER_ID'] = $_POST['REPORTER_Insight_ID'];
        $_SESSION['INSIGHT_REPORTER_FIRST'] = $_POST['FIRST'];
        $_SESSION['INSIGHT_REPORTER_LAST'] = $_POST['LAST'];
    }

    if(isset($_POST['MODERATOR_Insight_ID'])){
        $_SESSION['INSIGHT_MODERATOR_ID'] = $_POST['MODERATOR_Insight_ID'];
        $_SESSION['INSIGHT_MODERATOR_FIRST'] = $_POST['FIRST'];
        $_SESSION['INSIGHT_MODERATOR_LAST'] = $_POST['LAST'];
    }


    if(isset($_POST['Reminder_Post_ID'])){
        $Reminder_Post_ID = $_POST['Reminder_Post_ID'];
        
        $query = "SELECT * FROM reminder WHERE Post_ID = '$Reminder_Post_ID'";
        $query_statement = $conn->query($query);
        $query_results = $query_statement->fetchAll(PDO::FETCH_ASSOC);
        
        if($query_results){
            foreach($query_results as $query_result){
                echo json_encode(array($query_result['Reminder_Date']));
            }
        }

    }

    if(isset($_POST['Reminder_Post_Delete_ID'])){

        $ID = $_POST['Reminder_Post_Delete_ID'];
        $System_Actor_ID = $_SESSION['System_Actor_ID'];

        $query = "DELETE FROM reminder WHERE Post_ID = :ID AND System_Actor_ID = :SA_ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        $query_statement->bindParam(':SA_ID',$System_Actor_ID,PDO::PARAM_STR);
        if ($query_statement->execute()) {
            echo "<script>window.open('../view/Moderator_Reminder.php','_self');</script>";
        }                              
    }


    if(isset($_POST['Update_Reminder'])){
        $ID = $_POST['reminder_id'];
        $Date = $_POST['reminder_date'];

        $Reminder = [
            'Post_ID' => $ID,
            'Reminder_Date' => $Date
        ];
        
        $sql = 'UPDATE reminder
                SET Reminder_Date = :Reminder_Date
                WHERE Post_ID = :Post_ID';
        
        $statement = $conn->prepare($sql);

        // bind params
        $statement->bindParam(':Reminder_Date', $Reminder['Reminder_Date']);
        $statement->bindParam(':Post_ID', $Reminder['Post_ID']);

        // execute the UPDATE statment
        if ($statement->execute()) {
            echo "<script>window.open('../view/Moderator_Reminder.php','_self');</script>";
        }

    }


    if(isset($_POST['Add_Reminder'])){
        
        $ID = $_POST['add_reminder_id'];
        $Type = $_POST['add_reminder_type'];
        $Date = $_POST['add_reminder_date'];
        $USERID = $_SESSION['System_Actor_ID'];

        $reminder_post_sql = $conn->prepare("INSERT INTO `reminder` VALUES(?,?,?,?)");
        $reminder_post_sql->execute([$ID,$USERID,$Date,$Type]);
        echo "<script>window.open('../view/Moderator_Reminder.php','_self');</script>";
    }


    if (isset($_POST['Complain'])) {

        $USERID = $_SESSION['System_Actor_ID'];
    
        $last_value_sql = "SELECT Complaint_ID FROM complaint ORDER BY Complaint_ID DESC LIMIT 1";
        $last_value_statement = $conn->query($last_value_sql);
        $last_value_results = $last_value_statement->fetchAll(PDO::FETCH_ASSOC);
    
        if ($last_value_results) {
          foreach ($last_value_results as $last_value_result) {
            $connect = substr($last_value_result['Complaint_ID'], 4) + 1;
            $ID = "COM-" . $connect;
          }
          $date = date('Y-m-d');
          $NewsId = $_POST['NewsId'];
          $Type = $_POST['Type'];
          $Description = $_POST['Description'];
    
          $stmt = $conn->prepare("INSERT INTO `complaint`(`Complaint_ID`, `Complainer_ID`, `News_ID`, `Date`, `Category`, `Details`) VALUES (?,?,?,?,?,?)");
          $stmt->execute([$ID, $USERID, $NewsId, $date, $Type,  $Description]);
    
          echo '<script type="text/javascript">window.open("../view/Moderator_View_News.php", "_self");</script>';

        }

    }

    if (isset($_POST['smart_show'])) {
        $_SESSION['SMART_CAL'] = $_POST['smart_pid'];
        echo '<script type="text/javascript">window.open("../view/Moderator_Smart_Calendar.php", "_self");</script>';

    }

    if (isset($_POST['REMOVE_SMART'])) {
        
        $ID = $_SESSION['SMART_CAL'];
        
        $query = "DELETE FROM smart_calendar WHERE Post_Id = :ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        if ($query_statement->execute()) {
            echo '<script type="text/javascript">window.open("../view/Moderator_View_News.php", "_self");</script>';
        }    

        

    }

    if(isset($_POST['update_smart_calandar'])){
        $ID = $_POST['smart_id'];
        $Date = $_POST['smart_update'];

        $Smart = [
            'Post_ID' => $ID,
            'Smart_Date' => $Date
        ];
        
        $sql = 'UPDATE smart_calendar
                SET evt_start = :Smart_Date,
                evt_end = :Smart_Date
                WHERE Post_Id = :Post_ID';
        
        $statement = $conn->prepare($sql);

        // bind params
        $statement->bindParam(':Smart_Date', $Smart['Smart_Date']);
        $statement->bindParam(':Post_ID', $Smart['Post_ID']);

        // execute the UPDATE statment
        if ($statement->execute()) {
            echo "<script>window.open('../view/Moderator_View_News.php','_self');</script>";
        }

    }
    
?>