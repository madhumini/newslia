<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Home</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/complaint_tables.css">
    <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">


</head>

<style>
 
  .complaint_list{
      margin-top:3rem;
  }

  .content{
    margin-top:1rem;
  }
</style>



<body>

<!--navigation-->

<?php $page = 'complaints';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->



<!--Admin Page Content -->
<form action="./Complaints.php" method="POST" class = "complaint_list">


<div class="title"><center><h3>COMPLAINTS</h3></center></div>
  <div class="content">
  <table>
 <tr><th>Complaint ID</th><th>Date</th><th>Complainer_ID</th><th>News_ID</th><th>Details</th><th></th><th></th></tr>

 <?php
include '../Model/connect.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $sql = 'select * from complaint';

    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<?php while ($row = $q->fetch()): ?>           

 <tr>
     <td><?php echo $row['Complaint_ID']; ?></td>
     <td><?php echo $row['Date']; ?></td>
     <td> <?php echo $row['Complainer_ID'] ?></td>
     <td> <?php echo $row['News_ID'] ?></td>
     <td><textarea rows="3" cols="40" disabled class="input1" id="description" name="Details" ><?php echo $row['Details']; ?></textarea></td>
     
     <td>
       <form action='./Complaints.php' method='POST'>
         <input type="hidden" name="Complaint_ID" value="<?php echo $row['Complaint_ID']?>" > 
         <input type="hidden" name="Complainer_ID" value="<?php echo $row['Complainer_ID']?>" >
         <input type="hidden" name="News_ID" value="<?php echo $row['News_ID']?>" >
         <input type="hidden" name="Date" value="<?php echo $row['Date']?>" >
         <input type="hidden" name="Details" value="<?php echo $row['Details']?>" >
         
         <input type="submit" name="Accept_Complaint" value="Accept" class="accept">
       </form>
    </td>
    
    <td>

      <form action='./Complaints.php' method='POST'>

         <input type="hidden" name="Complaint_ID" value="<?php echo $row['Complaint_ID']?>" >
         <input type="hidden" name="Complainer_ID" value="<?php echo $row['Complainer_ID']?>" >
         <input type="hidden" name="News_ID" value="<?php echo $row['News_ID']?>" >
         <input type="hidden" name="Date" value="<?php echo $row['Date']?>" >
         <input type="hidden" name="Details" value="<?php echo $row['Details']?>" >

         <input type="submit" name="Reject_Complaint" value="Reject" class="reject">

      </form>
      
    </td>


 </tr>

<?php endwhile; ?>
</table>
</form>


<?php

  if(isset($_POST['Accept_Complaint'])){
      
      $CID = $_POST['Complaint_ID'];
      $UID = $_POST['Complainer_ID'];
      $NID = $_POST['News_ID'];
      $Date = $_POST['Date'];
      $Details = $_POST['Details'];

      $accept_sql = $conn->prepare("INSERT INTO `accept_complaint` VALUES(?,?,?,?,?)");
      $result = $accept_sql->execute([$CID,$UID,$NID,$Date,$Details]);

      if($result){
        $query = "DELETE FROM complaint WHERE Complaint_ID  = :CID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':CID',$CID);
        $query_statement->execute();


        $reporter_sql = "SELECT * FROM news WHERE (Post_ID = '$NID')";
        $reporter_state = $conn->query($reporter_sql);
        $reporter_results = $reporter_state->fetchAll(PDO::FETCH_ASSOC);

        if ($reporter_results){
             foreach($reporter_results as $reporter_result){

                $RID = $reporter_result['Creator_ID'];
                $reporter_com_sql = $conn->prepare("INSERT INTO `reporter_complaints`(`Complaint_ID`,`System_Reporter_ID`,`News_ID`) VALUES(?,?,?)");
                $reporter_com_sql->execute([$CID,$RID,$NID]);


                $reporter_sql = "SELECT count(Complaint_ID) AS NOC FROM reporter_complaints WHERE (News_ID = '$NID' AND capture = 0)";
                $reporter_state = $conn->query($reporter_sql);
                $reporter_results = $reporter_state->fetchAll(PDO::FETCH_ASSOC);


                if($reporter_results){
                  foreach($reporter_results as $reporter_result){
                    if($reporter_result['NOC'] >= 5){
                      //black star 1
                      // And one complaint for that news

                      $complaint =[
                        'id' => $NID,
                        'capture' => 1
                      ];
                
                      $sql = 'UPDATE reporter_complaints
                            SET capture = :capture
                            WHERE News_ID = :id';
                    
                      $statement = $conn->prepare($sql);
                      $statement->bindParam(':id', $complaint['id']);
                      $statement->bindParam(':capture', $complaint['capture']);
                      $statement->execute();

                      $reporter_info_sql = "SELECT * FROM reporter_insights WHERE (System_Actor_Id = '$RID')";
                      $reporter_info_state = $conn->query($reporter_info_sql);
                      $reporter_info_results = $reporter_info_state->fetchAll(PDO::FETCH_ASSOC);


                      if($reporter_info_results){
                        foreach($reporter_info_results as $reporter_info_result){
                            $black_star = $reporter_info_result['Stars'] + 1;
                            $complaint_c = $reporter_info_result['Complaints'] + 1;
 
                            echo "<script>alert(".$complaint_c.")</script>";
                            echo "<script>alert(".$black_star.")</script>";

                          //Update reporter insights
                            $reporterinfo =[
                              'id' => $RID,
                              'Complaints' => $complaint_c,
                              'Stars' => $black_star
                            ];
                      
                            $sql = 'UPDATE reporter_insights
                                  SET Complaints = :Complaints
                                  WHERE System_Actor_Id  = :id';
                          
                            $statement = $conn->prepare($sql);
                            $statement->bindParam(':id', $reporterinfo['id']);
                            $statement->bindParam(':Complaints', $reporterinfo['Complaints']);
                            $statement->execute();
                              
                            $sql = 'UPDATE reporter_insights
                                  SET Stars = :Stars 
                                  WHERE System_Actor_Id  = :id';
                          
                            $statement = $conn->prepare($sql);
                            $statement->bindParam(':id', $reporterinfo['id']);
                            $statement->bindParam(':Stars', $reporterinfo['Stars']);
                            $statement->execute();


                                //Update login table

                                
                                if($black_star >= 5){
                                  $systemuser =[
                                    'id' => $RID,
                                    'active' => 1
                                  ];
                            
                                  $sql = 'UPDATE login
                                          SET Blacklist = :active
                                          WHERE System_Actor_ID = :id';
                                  
                                  $statement = $conn->prepare($sql);
                                  $statement->bindParam(':id', $systemuser['id']);
                                  $statement->bindParam(':active', $systemuser['active']);
                                  
                                  if($statement->execute()){
                                    echo '<script>alert("login_upd")</script>';
                                  }

                              }

                              ///////////////////
                              //adding  1 complaint to moderator who approved 

                            $moderator_info_sql = "SELECT Moderator_ID FROM notification WHERE (Post_ID = '$NID')";
                            $moderator_info_state = $conn->query($moderator_info_sql);
                            $moderator_info_results = $moderator_info_state->fetchAll(PDO::FETCH_ASSOC);

                              if ($moderator_info_results){
                                foreach($moderator_info_results as $moderator_info_result){
                                              
                                  $MID = $moderator_info_result['Moderator_ID'];
                                  $moderator_insight_sql = "SELECT * FROM moderate_insights WHERE (System_Actor_Id = '$MID')";
                                  $moderator_insight_state = $conn->query($moderator_insight_sql);
                                  $moderator_insight_results = $moderator_insight_state->fetchAll(PDO::FETCH_ASSOC);
                                        
                                  if ($moderator_insight_results){
                                    foreach($moderator_insight_results as $moderator_insight_result){
                                        $MCC = $moderator_insight_result['Complaints'] + 1;

                                        $systemuser =[
                                            'id' => $MID,
                                            'Complaints' => $MCC
                                        ];                        

                                        $sql = 'UPDATE moderate_insights
                                            SET Complaints = :Complaints
                                            WHERE System_Actor_Id  = :id';
                                                          
                                        $statement = $conn->prepare($sql);
                                        $statement->bindParam(':id', $systemuser['id']);
                                        $statement->bindParam(':Complaints', $systemuser['Complaints']);
                                        $statement->execute();
                                    }
                                  }

                                }
                              }
                            

                        }
                      }

                      

                    }
                  }
                }


             }
        }
      
      }



      echo "<script>window.open('./Accepted Complaints.php','_self')</script>";
      

  }
  
  if(isset($_POST['Reject_Complaint'])){
      
      $CID = $_POST['Complaint_ID'];
      $UID = $_POST['Complainer_ID'];
      $NID = $_POST['News_ID'];
      $Date = $_POST['Date'];
      $Details = $_POST['Details'];

      $reject_sql = $conn->prepare("INSERT INTO `reject_complaint` VALUES(?,?,?,?,?)");
      $result = $reject_sql->execute([$CID,$UID,$NID,$Date,$Details]);

      if($result){
        $query = "DELETE FROM complaint WHERE Complaint_ID  = :CID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':CID',$CID);
        $query_statement->execute();
      }
      
      echo "<script>window.open('./Rejected Complaints.php','_self')</script>";

  }

?>

</body>
</html>

