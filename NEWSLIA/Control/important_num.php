<?php
    session_start();
    
    include '../Model/connect.php'; 
    if(isset($_POST['tm']) && !empty($_POST['tm'])){
        $TM = $_POST['tm'];
        $query = "SELECT * FROM important_number WHERE Contact_ID = '$TM'";
        $query_statement = $conn->query($query);
        $query_results = $query_statement->fetchAll(PDO::FETCH_ASSOC);
                       
        if($query_results){
            foreach($query_results as $query_result){

                $numbers = array("0","1");
               
                $query_numbers = "SELECT * FROM important_number_list WHERE Contact_ID = '$TM'";
                $query_statement_numbers = $conn->query($query_numbers);
                $query_results_numbers = $query_statement_numbers->fetchAll(PDO::FETCH_ASSOC);

                if($query_results_numbers){
                    $i = 0;
                    foreach($query_results_numbers as $query_results_number){
                        $numbers[$i] = $query_results_number['Number'];
                        $i++;
                    }
                }
                
                $_SESSION['ICN-ID'] = $TM;
                $_SESSION['Contact-N1'] = $numbers[0];
                $_SESSION['Contact-N2'] = $numbers[1];

                echo json_encode(array($query_result['Title'],$numbers[0],$numbers[1]));
                
            }
        }
        
        
    }


    if(isset($_POST['delete_i_c_n'])){
        $ID = $_POST['ID'];
        $query = "DELETE FROM important_number WHERE Contact_ID = :ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        if ($query_statement->execute()) {
            echo "<script>window.open('../view/Moderator_Manage_ICN.php','_self');</script>";
        }      
    }


    

    

?>