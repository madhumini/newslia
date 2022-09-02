<?php

    include '../Model/connect.php'; 
    if(isset($_POST['Province']) && !empty($_POST['Province'])){
        $province = $_POST['Province'];
        $query = "SELECT * FROM dsa WHERE Province = '$province' GROUP BY District";
        $query_statement = $conn->query($query);
        $query_results = $query_statement->fetchAll(PDO::FETCH_ASSOC);
                       
        if($query_results){
            foreach($query_results as $query_result){
                echo "<option value=".$query_result['District'].">".$query_result['District']."</option>"; 
            }
        }
        else{
            echo '<option value="">District not available</option>';
        }
    }


    elseif(isset($_POST['District']) && !empty($_POST['District'])){
        $district = $_POST['District'];
        $query = "SELECT * FROM dsa WHERE District = '$district'";
        $query_statement = $conn->query($query);
        $query_results = $query_statement->fetchAll(PDO::FETCH_ASSOC);
                               
        if($query_results){
            foreach($query_results as $query_result){
                echo "<option value=".$query_result['DSA'].">".$query_result['DSA']."</option>";
            }
        }
        else{
            //echo '<option value="">Provinces not available</option>';
        }
    }

?>