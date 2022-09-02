<?php
    
    include '../Model/connect.php';
    $Moderator_Area = $_SESSION['moderate_area'];
 
//News
      $pending_post_sql = "SELECT * FROM news_pending";
      $pending_post_statement = $conn -> query($pending_post_sql);
      $pending_post_results = $pending_post_statement->fetchAll(PDO::FETCH_ASSOC);

      if($pending_post_results){
        foreach($pending_post_results as $pending_post_result){
            $Post_ID = $pending_post_result['Post_ID'];
                  
            $flag = 0;
            $Area = array();
            $y=0;

            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  if($post_from_result['Area'] == $Moderator_Area){
                      $flag = 1;
                  }
                  $Area[$y] = $post_from_result['Area'];
                  $y++;
                }
            }
                  
            if($flag == 1){
                $img = $pending_post_result['Image'];
                $img = base64_encode($img);
                $text = pathinfo($pending_post_result['Post_ID'], PATHINFO_EXTENSION);

                $Creator_ID = $pending_post_result['Creator_ID'];
                $Title = $pending_post_result['Title'];
                $Smart = $pending_post_result['Calendar_Date'];

                echo "
                  <div class='box-container'>
                      <div class='box_head'>
                        
                        <img src='data:image/".$text.";base64,".$img."'/>
                        
                        <div class='tag'>
                            <div class='tag_text'><abc>News</abc></div>
                        </div>

                      </div>

                      <div class='box_body'>
                         <h3>".$Title."</h3>";
                         echo "<div class='more'>
                              <p>".$Smart."</p>
                            </div>";

                          echo "<p><b><i>-</i>";
                            foreach ($Area as $value) {
                                echo "<i>".$value." - ";
                                echo "</i>";
                            } 
                          echo "</b></p>";

                          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $save_who_state = $conn->query($save_who_sql);
                          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_who_results){
                            foreach($save_who_results as $save_who_result){
                              echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                            }
                          }
                            
                          echo "<div class='setting_close'>
                             
                             <ul style='list-style:none;'>
                               <li onclick=toggle_view_News('$Post_ID');><img src='../images/Check.svg'></li>
                             </ul>
                             
                          </div>";
                            
                          echo "</div>
                          </div>";
                  }   
              }
            }   
   
//Article
        $pending_post_sql = "SELECT * FROM articles_pending";
        $pending_post_statement = $conn -> query($pending_post_sql);
        $pending_post_results = $pending_post_statement->fetchAll(PDO::FETCH_ASSOC);

        if($pending_post_results){
          foreach($pending_post_results as $pending_post_result){
              $Post_ID = $pending_post_result['Post_ID'];
                        
              
              $img = $pending_post_result['Image'];
              $img = base64_encode($img);
              $text = pathinfo($pending_post_result['Post_ID'], PATHINFO_EXTENSION);

              $Creator_ID = $pending_post_result['Creator_ID'];
              $Title = $pending_post_result['Title'];

              echo "
                 <div class='box-container'>
                    <div class='box_head'>
                          
                      <img src='data:image/".$text.";base64,".$img."'/>
                          
                      <div class='tag'>
                           <div class='tag_text'><abc>Articles</abc></div>
                      </div>

                      

                    </div>

                    <div class='box_body'>
                      <h3>".$Title."</h3>";
                       
                      echo "<p><b><i>-All Areas-</i></b></p>";

                      $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                      $save_who_state = $conn->query($save_who_sql);
                      $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                      if($save_who_results){
                          foreach($save_who_results as $save_who_result){
                            echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                          }
                      }
                              
                      echo "<div class='setting_close'>
                            
                            <ul style='list-style:none;'>
                                <li onclick=toggle_view_Articles('$Post_ID');><img src='../images/Check.svg'></li>
                            </ul>

                      </div>";
                              
                       echo "</div>
                       </div>";
                    
                }
              }


//Notices
      $pending_post_sql = "SELECT * FROM notices_pending";
      $pending_post_statement = $conn -> query($pending_post_sql);
      $pending_post_results = $pending_post_statement->fetchAll(PDO::FETCH_ASSOC);

      if($pending_post_results){
        foreach($pending_post_results as $pending_post_result){
            $Post_ID = $pending_post_result['Post_ID'];
                  
            $flag = 0;
            $Area = array();
            $y=0;

            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  if($post_from_result['Area'] == $Moderator_Area){
                      $flag = 1;
                  }
                  $Area[$y] = $post_from_result['Area'];
                  $y++;
                }
            }
                  
            if($flag == 1){
                $img = $pending_post_result['Image'];
                $img = base64_encode($img);
                $text = pathinfo($pending_post_result['Post_ID'], PATHINFO_EXTENSION);

                $Creator_ID = $pending_post_result['Creator_ID'];
                $Title = $pending_post_result['Title'];
                $Publish_Date = $pending_post_result['Publish Date'];
                $Publish_Time = $pending_post_result['Publish Time'];

                echo "
                  <div class='box-container'>
                      <div class='box_head'>
                        
                        <img src='data:image/".$text.";base64,".$img."'/>
                        
                        <div class='tag'>
                            <div class='tag_text'><abc>Notices</abc></div>
                        </div>

                        

                      </div>

                      <div class='box_body'>
                        <h3>".$Title."</h3>";
                      
                          echo "<p><b><i>-</i>";
                            foreach ($Area as $value) {
                                echo "<i>".$value." - ";
                                echo "</i>";
                            } 
                          echo "</b></p>";

                          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $save_who_state = $conn->query($save_who_sql);
                          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_who_results){
                            foreach($save_who_results as $save_who_result){
                              echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                            }
                          }

                          echo "<p>".$Publish_Date." ".$Publish_Time."</p>";
                            
                          echo "<div class='setting_close'>
                              <ul style='list-style:none;'>
                                <li onclick=toggle_view_Ads('$Post_ID','Notices');><img src='../images/Check.svg'></li>
                            </ul>
                          </div>";
                            
                          echo "</div>
                          </div>";
                  }   
              }
            }





//Job Vacancies
      $pending_post_sql = "SELECT * FROM job_vacancies_pending";
      $pending_post_statement = $conn -> query($pending_post_sql);
      $pending_post_results = $pending_post_statement->fetchAll(PDO::FETCH_ASSOC);

      if($pending_post_results){
        foreach($pending_post_results as $pending_post_result){
            $Post_ID = $pending_post_result['Post_ID'];
                  
            $flag = 0;
            $Area = array();
            $y=0;

            $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
            $post_from_state = $conn->query($post_from_sql);
            $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

            if($post_from_results){
                foreach($post_from_results as $post_from_result){
                  if($post_from_result['Area'] == $Moderator_Area){
                      $flag = 1;
                  }
                  $Area[$y] = $post_from_result['Area'];
                  $y++;
                }
            }
                  
            if($flag == 1){
                $img = $pending_post_result['Image'];
                $img = base64_encode($img);
                $text = pathinfo($pending_post_result['Post_ID'], PATHINFO_EXTENSION);

                $Creator_ID = $pending_post_result['Creator_ID'];
                $Title = $pending_post_result['Position'];
                $Company = $pending_post_result['Company'];
                $Publish_Date = $pending_post_result['Set_Date'];
                $Publish_Time = $pending_post_result['Set_Time'];
                
                echo "
                  <div class='box-container'>
                      <div class='box_head'>
                        
                        <img src='data:image/".$text.";base64,".$img."'/>
                        
                        <div class='tag'>
                            <div class='tag_text'><abc>Vacancies</abc></div>
                        </div>

                        

                      </div>

                      <div class='box_body'>
                        <h3>".$Title." (".$Company.")</h3>";
                      
                          echo "<p><b><i>-</i>";
                            foreach ($Area as $value) {
                                echo "<i>".$value." - ";
                                echo "</i>";
                            } 
                          echo "</b></p>";

                          $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                          $save_who_state = $conn->query($save_who_sql);
                          $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                          if($save_who_results){
                            foreach($save_who_results as $save_who_result){
                              echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                            }
                          }

                          echo "<p>".$Publish_Date." ".$Publish_Time."</p>";
                            
                          echo "<div class='setting_close'>
                              <ul style='list-style:none;'>
                                <li onclick=toggle_view_Ads('$Post_ID','Vacancies');><img src='../images/Check.svg'></li>
                              </ul>
                          </div>";
                            
                          echo "</div>
                          </div>";
                  }   
              }
            }




//Com. Advertisment
        $pending_post_sql = "SELECT * FROM com_ads_pending";
        $pending_post_statement = $conn -> query($pending_post_sql);
        $pending_post_results = $pending_post_statement->fetchAll(PDO::FETCH_ASSOC);

        if($pending_post_results){
          foreach($pending_post_results as $pending_post_result){
              $Post_ID = $pending_post_result['Post_ID'];
                    
              $flag = 0;
              $Area = array();
              $y=0;

              $post_from_sql = "SELECT * FROM post_area WHERE Post_ID='$Post_ID'";
              $post_from_state = $conn->query($post_from_sql);
              $post_from_results = $post_from_state->fetchAll(PDO::FETCH_ASSOC);

              if($post_from_results){
                  foreach($post_from_results as $post_from_result){
                    if($post_from_result['Area'] == $Moderator_Area){
                        $flag = 1;
                    }
                    $Area[$y] = $post_from_result['Area'];
                    $y++;
                  }
              }
                    
              if($flag == 1){
                  $img = $pending_post_result['Image'];
                  $img = base64_encode($img);
                  $text = pathinfo($pending_post_result['Post_ID'], PATHINFO_EXTENSION);

                  $Creator_ID = $pending_post_result['Creator_ID'];
                  $Title = $pending_post_result['Title'];
                  $Publish_Date = $pending_post_result['Set_Date'];
                  $Publish_Time = $pending_post_result['Set_Time'];
                  
                  echo "
                    <div class='box-container'>
                        <div class='box_head'>
                          
                          <img src='data:image/".$text.";base64,".$img."'/>
                          
                          <div class='tag'>
                              <div class='tag_text'><abc>Ads</abc></div>
                          </div>

                          

                        </div>

                        <div class='box_body'>
                          <h3>".$Title."</h3>";
                        
                            echo "<p><b><i>-</i>";
                              foreach ($Area as $value) {
                                  echo "<i>".$value." - ";
                                  echo "</i>";
                              } 
                            echo "</b></p>";

                            $save_who_sql = "SELECT * FROM system_actor WHERE System_Actor_Id='$Creator_ID'";
                            $save_who_state = $conn->query($save_who_sql);
                            $save_who_results = $save_who_state->fetchAll(PDO::FETCH_ASSOC);

                            if($save_who_results){
                              foreach($save_who_results as $save_who_result){
                                echo "<p>".$save_who_result['FirstName']." ".$save_who_result['LastName']."</p>";    
                              }
                            }

                            echo "<p>".$Publish_Date." ".$Publish_Time."</p>";
                              
                            echo "<div class='setting_close'>
                                    <ul style='list-style:none;'>
                                      <li onclick=toggle_view_Ads('$Post_ID','C.Ads');><img src='../images/Check.svg'></li>
                                    </ul>
                            </div>";
                              
                            echo "</div>
                            </div>";
                    }   
                }
              }
                
?>