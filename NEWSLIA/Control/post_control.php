<?php

session_start();
date_default_timezone_set("Asia/Calcutta");

include '../Model/connect.php'; 


if(isset($_POST['save_post_id'])){
    $USERID = $_SESSION['System_Actor_ID'];
    $POSTID = $_POST['save_post_id'];
    $save_post_sql = $conn->prepare("INSERT INTO `save` VALUES(?,?,?)");
    $save_post_sql->execute([$POSTID,$USERID,$_POST['Type']]);
    
}

if(isset($_POST['hidden_post_id'])){
    $USERID = $_SESSION['System_Actor_ID'];
    $POSTID = $_POST['hidden_post_id'];
    $hidden_post_sql = $conn->prepare("INSERT INTO `hidden` VALUES(?,?,?)");
    $hidden_post_sql->execute([$POSTID,$USERID,$_POST['Type']]);
    
}

if(isset($_POST['view_post_id'])){

    $Post_ID = $_POST['view_post_id'];
    $System_Time = date("H:i:s");
    $System_Date = date("Y-m-d");
    $Opening_Time = 0;
   
    $_SESSION['READ_VIEW_Post_ID'] = $_POST['view_post_id'];
    $_SESSION['READ_VIEW_TYPE'] = $_POST['Type'];

    $read_post_sql = "SELECT * FROM read_time WHERE Post_ID = '$Post_ID'";
    $read_post_statement = $conn->query($read_post_sql);
    $read_post_results = $read_post_statement->fetchAll(PDO::FETCH_ASSOC);

    if($read_post_results){
        foreach($read_post_results as $read_post_result){
            $Opening_Time = $read_post_result['Opening_Time'] + 1;      
        }
    }

    $LAST_READ = [
        'Post_ID' => $Post_ID,
        'Opening_Time' => $Opening_Time,
        'Last_Read_Date' => $System_Date,
        'Last_Read_Time' => $System_Time
    ];

    $sql_update_read_time = "UPDATE read_time
                             SET Opening_Time = :Opening_Time,
                             Last_Read_Date = :Last_Read_Date,
                             Last_Read_Time = :Last_Read_Time
                             WHERE Post_ID = :Post_ID";
    
    $statement_update_read_time = $conn->prepare($sql_update_read_time);
    
    $statement_update_read_time->bindParam(':Post_ID',$LAST_READ['Post_ID']);
    $statement_update_read_time->bindParam(':Opening_Time',$LAST_READ['Opening_Time']);
    $statement_update_read_time->bindParam(':Last_Read_Date',$LAST_READ['Last_Read_Date']);
    $statement_update_read_time->bindParam(':Last_Read_Time',$LAST_READ['Last_Read_Time']);

    $statement_update_read_time->execute();

}


if(isset($_POST['Voter_ID'])){

    $Post_ID = $_POST['Post_ID'];
    $Voter = $_POST['Voter_ID'];
    $Vote = $_POST['Vote'];

    $sql = "DELETE FROM vote WHERE Post_ID = :Post_ID AND System_Actor_ID = :System_Actor_ID";

    // prepare the statement for execution
    $statement = $conn->prepare($sql);
    $statement->bindParam(':Post_ID', $Post_ID);
    $statement->bindParam(':System_Actor_ID', $Voter);

    // execute the statement
    $statement->execute();

    $Add_Vote = $conn->prepare("INSERT INTO `vote` VALUES(?,?,?)");
    $Add_Vote->execute([$Post_ID,$Voter,$Vote]);
}


if(isset($_POST['delete_news_post_id'])){
    
    $Post_ID = $_POST['delete_news_post_id'];

    //If anyone save this articles
    $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();

    //If anyone hidden this articles
    $sql2 = "DELETE FROM hidden WHERE Post_ID = :Post_ID";
    $statement2 = $conn->prepare($sql2);
    $statement2->bindParam(':Post_ID', $Post_ID);
    $statement2->execute();

    //remove read time of the articles
    $sql3 = "DELETE FROM read_time WHERE Post_ID = :Post_ID";
    $statement3 = $conn->prepare($sql3);
    $statement3->bindParam(':Post_ID', $Post_ID);
    $statement3->execute();

    //remove news from main table
    $sql4 = "DELETE FROM news WHERE Post_ID = :Post_ID";
    $statement4 = $conn->prepare($sql4);
    $statement4->bindParam(':Post_ID', $Post_ID);
    $statement4->execute();

    //remove notification from main table
    $sql5 = "DELETE FROM notification WHERE Post_ID = :Post_ID";
    $statement5 = $conn->prepare($sql5);
    $statement5->bindParam(':Post_ID', $Post_ID);
    $statement5->execute();


    //remove post_area from main table
    $sql6 = "DELETE FROM post_area WHERE Post_ID = :Post_ID";
    $statement6 = $conn->prepare($sql6);
    $statement6->bindParam(':Post_ID', $Post_ID);
    $statement6->execute();


    //remove post_auto_delete from main table
    $sql7 = "DELETE FROM post_auto_delete WHERE Post_ID = :Post_ID";
    $statement7 = $conn->prepare($sql7);
    $statement7->bindParam(':Post_ID', $Post_ID);
    $statement7->execute();


    //remove reminder from main table
    $sql8 = "DELETE FROM reminder WHERE Post_ID = :Post_ID";
    $statement8 = $conn->prepare($sql8);
    $statement8->bindParam(':Post_ID', $Post_ID);
    $statement8->execute();


    //remove smart_calendar from main table
    $sql9 = "DELETE FROM smart_calendar WHERE Post_Id = :Post_ID";
    $statement9 = $conn->prepare($sql9);
    $statement9->bindParam(':Post_ID', $Post_ID);
    $statement9->execute();


    //remove vote from main table
    $sql10 = "DELETE FROM vote WHERE Post_ID = :Post_ID";
    $statement10 = $conn->prepare($sql10);
    $statement10->bindParam(':Post_ID', $Post_ID);
    $statement10->execute();



}



if(isset($_POST['delete_notices_post_id'])){
    
    $Post_ID = $_POST['delete_notices_post_id'];

    //If anyone save this articles
    $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();

    //If anyone hidden this articles
    $sql2 = "DELETE FROM hidden WHERE Post_ID = :Post_ID";
    $statement2 = $conn->prepare($sql2);
    $statement2->bindParam(':Post_ID', $Post_ID);
    $statement2->execute();

    //remove read time of the articles
    $sql3 = "DELETE FROM read_time WHERE Post_ID = :Post_ID";
    $statement3 = $conn->prepare($sql3);
    $statement3->bindParam(':Post_ID', $Post_ID);
    $statement3->execute();

    //remove notices from main table
    $sql4 = "DELETE FROM notices WHERE Post_ID = :Post_ID";
    $statement4 = $conn->prepare($sql4);
    $statement4->bindParam(':Post_ID', $Post_ID);
    $statement4->execute();

    //remove notification from main table
    $sql5 = "DELETE FROM notification WHERE Post_ID = :Post_ID";
    $statement5 = $conn->prepare($sql5);
    $statement5->bindParam(':Post_ID', $Post_ID);
    $statement5->execute();


    //remove post_area from main table
    $sql6 = "DELETE FROM post_area WHERE Post_ID = :Post_ID";
    $statement6 = $conn->prepare($sql6);
    $statement6->bindParam(':Post_ID', $Post_ID);
    $statement6->execute();


    //remove post_auto_delete from main table
    $sql7 = "DELETE FROM post_auto_delete WHERE Post_ID = :Post_ID";
    $statement7 = $conn->prepare($sql7);
    $statement7->bindParam(':Post_ID', $Post_ID);
    $statement7->execute();


    //remove reminder from main table
    $sql8 = "DELETE FROM reminder WHERE Post_ID = :Post_ID";
    $statement8 = $conn->prepare($sql8);
    $statement8->bindParam(':Post_ID', $Post_ID);
    $statement8->execute();

}



if(isset($_POST['delete_vacancies_post_id'])){
    
    $Post_ID = $_POST['delete_vacancies_post_id'];

    //If anyone save this articles
    $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();

    //If anyone hidden this articles
    $sql2 = "DELETE FROM hidden WHERE Post_ID = :Post_ID";
    $statement2 = $conn->prepare($sql2);
    $statement2->bindParam(':Post_ID', $Post_ID);
    $statement2->execute();

    //remove read time of the articles
    $sql3 = "DELETE FROM read_time WHERE Post_ID = :Post_ID";
    $statement3 = $conn->prepare($sql3);
    $statement3->bindParam(':Post_ID', $Post_ID);
    $statement3->execute();

    //remove notices from main table
    $sql4 = "DELETE FROM job_vacancies WHERE Post_ID = :Post_ID";
    $statement4 = $conn->prepare($sql4);
    $statement4->bindParam(':Post_ID', $Post_ID);
    $statement4->execute();

    //remove notification from main table
    $sql5 = "DELETE FROM notification WHERE Post_ID = :Post_ID";
    $statement5 = $conn->prepare($sql5);
    $statement5->bindParam(':Post_ID', $Post_ID);
    $statement5->execute();


    //remove post_area from main table
    $sql6 = "DELETE FROM post_area WHERE Post_ID = :Post_ID";
    $statement6 = $conn->prepare($sql6);
    $statement6->bindParam(':Post_ID', $Post_ID);
    $statement6->execute();


    //remove post_auto_delete from main table
    $sql7 = "DELETE FROM post_auto_delete WHERE Post_ID = :Post_ID";
    $statement7 = $conn->prepare($sql7);
    $statement7->bindParam(':Post_ID', $Post_ID);
    $statement7->execute();


    //remove reminder from main table
    $sql8 = "DELETE FROM reminder WHERE Post_ID = :Post_ID";
    $statement8 = $conn->prepare($sql8);
    $statement8->bindParam(':Post_ID', $Post_ID);
    $statement8->execute();
    
}


if(isset($_POST['delete_c_ads_post_id'])){
    
    $Post_ID = $_POST['delete_c_ads_post_id'];

    //If anyone save this articles
    $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();

    //If anyone hidden this articles
    $sql2 = "DELETE FROM hidden WHERE Post_ID = :Post_ID";
    $statement2 = $conn->prepare($sql2);
    $statement2->bindParam(':Post_ID', $Post_ID);
    $statement2->execute();

    //remove read time of the articles
    $sql3 = "DELETE FROM read_time WHERE Post_ID = :Post_ID";
    $statement3 = $conn->prepare($sql3);
    $statement3->bindParam(':Post_ID', $Post_ID);
    $statement3->execute();

    //remove notices from main table
    $sql4 = "DELETE FROM com_ads WHERE Post_ID = :Post_ID";
    $statement4 = $conn->prepare($sql4);
    $statement4->bindParam(':Post_ID', $Post_ID);
    $statement4->execute();

    //remove notification from main table
    $sql5 = "DELETE FROM notification WHERE Post_ID = :Post_ID";
    $statement5 = $conn->prepare($sql5);
    $statement5->bindParam(':Post_ID', $Post_ID);
    $statement5->execute();


    //remove post_area from main table
    $sql6 = "DELETE FROM post_area WHERE Post_ID = :Post_ID";
    $statement6 = $conn->prepare($sql6);
    $statement6->bindParam(':Post_ID', $Post_ID);
    $statement6->execute();


    //remove post_auto_delete from main table
    $sql7 = "DELETE FROM post_auto_delete WHERE Post_ID = :Post_ID";
    $statement7 = $conn->prepare($sql7);
    $statement7->bindParam(':Post_ID', $Post_ID);
    $statement7->execute();


    //remove reminder from main table
    $sql8 = "DELETE FROM reminder WHERE Post_ID = :Post_ID";
    $statement8 = $conn->prepare($sql8);
    $statement8->bindParam(':Post_ID', $Post_ID);
    $statement8->execute();
    
}

/*if(isset($_POST['delete_articles_post_id'])){
    
    $Post_ID = $_POST['delete_articles_post_id'];

    //If anyone save this articles
    $sql1 = "DELETE FROM save WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();

}

if(isset($_POST['delete_important_post_id'])){
    
    $Post_ID = $_POST['delete_important_post_id'];

    //delete from important number
    $sql1 = "DELETE FROM important_number WHERE Post_ID = :Post_ID";
    $statement1 = $conn->prepare($sql1);
    $statement1->bindParam(':Post_ID', $Post_ID);
    $statement1->execute();


      //delete from important number list
       $sql2 = "DELETE FROM important_number_list WHERE Post_ID = :Post_ID";
       $statement2 = $conn->prepare($sql2);
       $statement2->bindParam(':Post_ID', $Post_ID);
       $statement2->execute();
}*/
?>
