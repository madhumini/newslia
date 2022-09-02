<?php

date_default_timezone_set("Asia/Calcutta");


include '../Model/connect.php';

$System_Time = date("H:i:s");
$System_Date = date("Y-m-d");

$read_time_sql = "SELECT * FROM read_time WHERE Post_ID = ''";
$read_time_state = $conn->query($read_time_sql);
$read_time_results = $read_time_state->fetchAll(PDO::FETCH_ASSOC);

        if($read_time_results){
            foreach($read_time_results as $read_time_result){

                $Read_Date = $read_time_result['Last_Read_Date'];
                $Read_Time = $read_time_result['Last_Read_Time'];

                $Date1 = new DateTime($Read_Date);
                $Date2 = new DateTime($System_Date);
                
                $time1 = new DateTime($Read_Time);
                $time2 = new DateTime($System_Time);

                $interval_Date = $Date1->diff($Date2);
                $interval_Time = $time1->diff($time2);
                
                echo $interval_Date->format("%Y:%m:%d");
                echo "<br>";
                echo $interval_Time->format("%H:%i:%s");    
                echo "<br>";

                if($interval_Date->format("%Y") == 0 and $interval_Date->format("%m") == 0 and $interval_Date->format("%d") == 0){

                    if($interval_Time->format("%i") == 0 and $interval_Time->format("%H") == 0){
                        echo "<i><span style='font-size:13px;color:#888;'>Last Read Few Seconds Ago</span>";    
                    }
                    elseif($interval_Time->format("%H") == 0){
                        echo "<i><span style='font-size:13px;color:#888;'>Last Read ".$interval_Time->format("%m")." Minutes Ago</span>"; 
                    }
                    else{
                        echo "<i><span style='font-size:13px;color:#888;'>Last Read ".$interval_Time->format("%H")." Hours Ago</span>"; 
                    }
                   
                }
                elseif($interval_Date->format("%Y") == 0 and $interval_Date->format("%m") == 0 and $interval_Date->format("%d") == 1){

                    echo "<i><span style='font-size:13px;color:#888;'>Last Read One Days Ago</span>"; 

                }
                elseif($interval_Date->format("%Y") == 0 and $interval_Date->format("%m") == 0 and $interval_Date->format("%d") == 2){

                   echo "<i><span style='font-size:13px;color:#888;'>Last Read Two Days Ago</span>"; 

                }
                else{

                    echo "<i><span style='font-size:13px;color:#888;'>Last Read ".$Read_Date."</span>"; 

                }

            }
        }

?>