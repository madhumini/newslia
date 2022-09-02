<?php
  session_start();
  //$_SESSION['Contact-ID'] = "None";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSLIA</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/addinput.css">
    <link rel="stylesheet" href="../css/error.css">
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link rel="shortcut icon" type = "image/x-icon" href = "../images/logo.ico">

</head>

<style>
  body {
    overflow-x: hidden; /* Hide scrollbars */
  }
  .box_head:hover img{
    opacity: 1;
  }
  
  .setting_close{
    transform:scale(1.2);
    margin-left:78%;
    margin-top :-12%;
  }
  .setting_close img{
    padding-right:5px;
    cursor: pointer;
  }

  .popup_add_new .content_add_new{
      height:450px;
      width: 400px;
  }

  .popup_add_new_size .content_add_new_size{
    height:580px;
  }

  .popup_remove_new .content_remove_new{
      height:300px;
      width: 400px;
  }

  .yes_no_btn{
    display:flex;
    flex-direction:row;
    margin-top:2rem;
  }
  
  .form-container input{
    margin-right:2rem;
    width:200px;
    float:right;
    
  }
  
.form-container label{
  margin-left:1rem;
  
}

.update_btn,.delete_btn{
  margin-left:7.2rem;
}
.insert_btn{
  margin-top:-1rem;
  border:none;
  transition: 0.25s ease;
  box-shadow: none;
}

.update_btn:hover,.delete_btn:hover{
   box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.25);
   transform:scale(1.08);
 }

 .delete_btn{
   margin-left:3rem;
 }

.popup_add_num .content_add_num{
  height:480px;
}

input{
  padding-left:5px;
}


.box-container{
    height: 260px;
  }

  .box_head img{
    height:50%;
  }

  .add_btn{
    transition:0.5s ease;
  }
  
  .add_btn:hover{
    transform:scale(1.2);
  }


  .message {
      display:block;
      background: #f1f1f1;
      color: #000;
      width: 70%;
      position: relative;
      padding: 5px;
      margin-top: 10px;
      top:-4rem;
      left:9.7rem;
      border-radius: 10px;
    }

  .message::before{
    content: "";
    position: absolute;
    right: 100%;
    top: 8px;
    width: 0;
    height: 0;
    border-top: 13px solid transparent;
    border-right: 26px solid #f1f1f1;
    border-bottom: 13px solid transparent;
    }

  .message p {
    padding: 5px 5px;
    font-size: 15px;
   }

  #msg1{
    display:none;
    top:-5rem;
    left:21rem;
  }

  #msg2{
    display:none;
    top:-8.2rem;
    left:21rem;
  }
  #msg3{
    display:none;
    top:-6rem;
    left:21rem;
  }

  .req1{
    position: relative;
    top:-2.5rem;
  }

  /* Add a green text color and a checkmark when the requirements are right */
  .valid {
    color: green;
    }

  .valid:before {
     position: relative;
     left: -4px;
     content: "✔";
    }

  /* Add a red text color and an "x" when the requirements are wrong */
  .invalid {
    color: red;
    }

  .invalid:before {
    position: relative;
    left: -4px;
    content: "✖";
  }

</style>

<body>




<!--navigation-->

<?php $page = 'important';
  include 'nav.php'; ?>

<!--End of Navigation-Bar-->


 



<!-- Moderator Important Number View -->
<div class="content_posts_view">
    <div class="posts_content_view_head">
        Edit Important Contact Numbers
    </div>

    <div class="post_sort" style="display:none;">
        <div class="post_sort_bar">
          <button onclick="showsort()" class="drop_area_sort">Select Area<img src="../images/sort.svg" alt="" srcset=""></button>
          <div class="drop_area_sort_cont" id="sortdrop">
            <img src="../images/search.svg" alt="" srcset="">
            <input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Search...">
            <a href="#">Gampaha</a>
            <a href="#">Minuwangoda</a>
            <a href="#">Negombo</a>
          </div>
        </div>
      </div>
        
    </div>

  
  <div class="add_btn" onclick="togglePop_newadd()">Add New</div>
      
</div>



<script>
   


   ///////////Remove //////////
    function togglePopupremove(){
      document.getElementById("popup-3").classList.remove("active");
    }

    function togglePopupremove_add(tm){

      const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("current_contact_number").value = tm;
      }
      xhttp.open("GET", tm);
      xhttp.send(); 

      $.ajax({
        url :"../Control/important_num.php",
        type:"POST",
        cache:false,
        data:{tm:tm},
        success:function(data){
          var result = $.parseJSON(data);
          $("#current_contact_name").text(result[0]);
        }
      });
      
      document.getElementById("popup-3").classList.add("active");
    }


    ///////////Update //////////
    function togglePopupupdate_remove(){
      document.getElementById("popup-1").classList.remove("active");
    }

    function togglePopupupdate_add(tm){

      const xhttp = new XMLHttpRequest(); 
      xhttp.onload = function() {
          document.getElementById("update-important-num").value = tm;
      }
      xhttp.open("GET", tm);
      xhttp.send(); 

      $.ajax({
        url :"../Control/important_num.php",
        type:"POST",
        cache:false,
        data:{tm:tm},
        success:function(data){
          var result = $.parseJSON(data);
          document.getElementById("update-important-name").value = result[0];
          document.getElementById("update-number1").value = result[1];

          if(result[2]!=1){

            document.getElementById("update-number2").value = result[2];

          }
          else{
            document.getElementById("update-number2").value = "";
          }

        }

      });

      document.getElementById("popup-1").classList.add("active");
    }


</script>


<div class="posts_content_view_body">

    <div class="body_information">
         
        <?php

        include '../Model/connect.php';
        $moderate_area = $_SESSION['moderate_area'];

        $import_sql = "SELECT * FROM important_number WHERE (Area = '$moderate_area') ORDER BY Contact_ID DESC";

        $import_state = $conn->query($import_sql);
        $import_results = $import_state->fetchAll(PDO::FETCH_ASSOC);

        if($import_results){
          foreach($import_results as $import_result){
            $img = $import_result['Image'];
            $img = base64_encode($img);
            $ext = pathinfo($import_result['Contact_ID'], PATHINFO_EXTENSION);
            
            
            echo "<div class='box-container'>";
            echo "<div class='box_head'>";
            echo "<img src='data:image/".$ext.";base64,".$img."'/>"; 
            echo "</div>";
            echo "<div class='box_body'>";
            echo "<h4>".$import_result['Title']."</h4>";
            $Id =  $import_result['Contact_ID'];
            echo "<p style='margin-bottom:5px;'><b>-".$import_result['Area']."-</b></p>";

            $CID = $import_result['Contact_ID'];
            $importnum_sql = "SELECT * FROM important_number_list WHERE (Contact_ID = '$CID')";
            $importnum_state = $conn->query($importnum_sql);
            $importnum_results = $importnum_state->fetchAll(PDO::FETCH_ASSOC);

            if($importnum_results){
                foreach($importnum_results as $importnum_result){
                  echo "<p>".$importnum_result['Number']."</p>";
                }
            }

            echo "</div>";
            echo "<div class='setting_close'>";
            echo "<img src='../images/pen.svg' onclick=togglePopupupdate_add('$Id');>";
            echo "<img src='../images/close_large.svg' onclick = togglePopupremove_add('$Id');>";
            
            echo "</div>";
            echo "</div>";

          }
        }
  
        ?>
          
    </div>

    
</div>


  

<div class="popup popup_add_new" id="popup-2">

      <div class="overlay"></div>

      <div class="content content_add_new" id="popup-2-content">
          <div class="close-btn" onclick="togglePop_newadd()">&times;</div>


          <div class="content_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Insert New Important Number</h3>
                  <form action="./Moderator_Manage_ICN.php" method="post" enctype="multipart/form-data">
                    
                        <div class="center_img">
                            <div class="form-input_img">
                              <label for="file-ip-1">Upload Image</label>
                              <input type="file" name="upload" id="file-ip-1" accept="image/*" onchange="showPreview(event);" required>
                              <div class="preview_img">
                              <img id="file-ip-1-preview">
                            </div>
                       </div>

              </div>
                    
                     <br>
                     <br>

                     <div class="form-container">

                          <label for="add-name" class="lbl">Name<span style="color:red;font-size:13px;margin-left:">*</span></label>
                          
                          <input type="text" name="ic_title" id="add-name" class="inp" required>
                          <br>
                          <br>

                          <label for="add-number" class="lbl">Number<span style="color:red;font-size:13px;">*</span></label>

                          <div id="survey_options" class="number">
                              <input type="text" name="num1[]" id="add-number" class="inp" required>                              
                          </div>

                         
                          
                          
                          <div class="controls">
                                 <a href="#" id="add_more_fields" class="mark add_num"><i class="fa fa-plus"></i>Add More</a>
                                 <a href="#" id="remove_fields" class="mark remove_num"><i class="fa fa-minus"></i>Remove Field</a>
                          </div>
                        
                          <div class="message" id="msg1">
                              <p id="mobile_validate" class="invalid">Mobile number</p>
                          </div> 
                          
                          <br>
                          
                     </div>
                     
                     <button class="update_btn insert_btn" id = "insert_btn_mobile" name="insert_i_c_n">Insert</button>
              
                   </form>
               </div>

          </div>
      </div>
      
</div>

<div class="popup popup_add_new" id="popup-1">

      <div class="overlay"></div>

      <div class="content content_add_new" id="popup-1-content">
          <div class="close-btn" onclick="togglePopupupdate_remove()">&times;</div>


          <div class="content_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Update New Important Number</h3>
                  <form action="Moderator_Manage_ICN.php" method="post" enctype="multipart/form-data">
                    
                        <div class="center_img">
                            <div class="form-input_img">
                              <label for="file-ip-2">Upload Image</label>
                              <input type="file" id="file-ip-2" name="update_upload" accept="image/*" onchange="showPreview_2(event);" required>
                              <div class="preview_img">
                              <img id="file-ip-2-preview">
                            </div>
                       </div>

              </div>
                    
              <br>
                     <br>

                     <div class="form-container">

                          <input type="text" name="ic_title" id="update-important-num" class="inp" required style="display:none;">

                          <label for="add-name" class="lbl">Name</label>
                          
                          <input type="text" name="ic_update_title" id="update-important-name" class="inp" required>
                          <br>
                          <br>

                          <label for="add-number" class="lbl">Number</label>

                          <div id="survey_update_options" class="number">
                          
                          <input type="text" name="num1" id="update-number1" class="inp" required>

                          <input type="text" name="num2" id="update-number2" class="inp">
                          
                        </div>
                     </div>
                            
                     <button class="update_btn insert_btn" name="update_i_c_n" style="margin-top:2px;">Update</button>

                        <div class="message" id="msg2">
                            <p id="mobile_validate_2" class="invalid">Mobile number </p>
                        </div> 
                        <div class="message" id="msg3">
                            <p id="mobile_validate_3" class="invalid">Mobile number </p>
                        </div> 

                   </form>
               </div>

          </div>
      </div>
      
</div>


<script>
  var new_mobile = document.getElementById("add-number");
  var validate_mobile = document.getElementById("mobile_validate");

  var update_mobile_1 = document.getElementById("update-number1");
  var update_mobile_2 = document.getElementById("update-number2");

  var validate_mobile_2 = document.getElementById("mobile_validate_2");
  var validate_mobile_3 = document.getElementById("mobile_validate_3");
  
  // Mobile Number Validation
  /*new_mobile.onfocus = function(){
      document.getElementById("msg1").style.display = "block";
      document.getElementById("insert_btn_mobile").classList.add("req1");
  }*/

  new_mobile.onblur = function(){
      document.getElementById("msg1").style.display = "none";
      document.getElementById("insert_btn_mobile").classList.remove("req1");
  }

  // When the user starts to type something inside the mobile field
  new_mobile.onkeyup = function(){
      document.getElementById("msg1").style.display = "block";
      document.getElementById("insert_btn_mobile").classList.add("req1");
      const mobileformat = /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$/;                  
      if(mobileformat.exec(new_mobile.value)) {  
        validate_mobile.classList.remove("invalid");
        validate_mobile.classList.add("valid");
      } else {
        validate_mobile.classList.remove("valid");
        validate_mobile.classList.add("invalid");
      }
  }

  /*update_mobile_1.onfocus = function(){
      document.getElementById("msg2").style.display = "block";
  }*/

  update_mobile_1.onblur = function(){
      document.getElementById("msg2").style.display = "none";
  }
  update_mobile_1.onkeyup = function(){
      document.getElementById("msg2").style.display = "block";
      const mobileformat = /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$/;                  
      if(mobileformat.exec(update_mobile_1.value)) {  
        validate_mobile_2.classList.remove("invalid");
        validate_mobile_2.classList.add("valid");
      } else {
        validate_mobile_2.classList.remove("valid");
        validate_mobile_2.classList.add("invalid");
      }
  }

  /*update_mobile_2.onfocus = function(){
      document.getElementById("msg3").style.display = "block";
  }*/

  update_mobile_2.onblur = function(){
      document.getElementById("msg3").style.display = "none";
  }
  update_mobile_2.onkeyup = function(){
    document.getElementById("msg3").style.display = "block";
      const mobileformat = /^(?:0|94|\+94)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(0|2|3|4|5|7|9)|7(0|1|2|4|5|6|7|8)\d)\d{6}$/;                  
      if(mobileformat.exec(update_mobile_2.value)) {  
        validate_mobile_3.classList.remove("invalid");
        validate_mobile_3.classList.add("valid");
      } else {
        validate_mobile_3.classList.remove("valid");
        validate_mobile_3.classList.add("invalid");
      }
  }

</script>

<div class="popup popup_remove_new" id="popup-3">

      <div class="overlay"></div>

      <div class="content content_remove_new" id="popup-1-content">
          <div class="close-btn" onclick="togglePopupremove()">&times;</div>


          <div class="content_body">
              <div class="popup_logo">
                   <img src="../images/Name.svg" alt="" srcset="">
              </div>
              <hr>

              <div class="popup_form">
                  <h3 class="popup_title">Delete Important Number</h3>
                  <form action="../Control/important_num.php" method="post">
                    
                     <p style="font-size:15px;color:#FF5544;">Do you need to remove 

                              
                              <input type="text" name="ID" id="current_contact_number" style="display:none;">
                              <i><span id="current_contact_name"></span></i>

                     contact number permanently?</p>
                         
                     <div class="yes_no_btn">
                          <button class="update_btn delete_btn insert_btn" name="delete_i_c_n">Yes</button>
                          <div class="update_btn delete_btn insert_btn" onclick="togglePopupremove()">No</div>
                     </div>
                     


                  </form>
               </div>

          </div>
      </div>
      
</div>






<div class="errorbox" id="error2">
  <div class="content_erro">
       <div class="error_head">NEWSLIA says</div>
       <div class="error_body">Incorrect Contact Number Format</div>
       <div class="error_foot" onclick="error_msg()">OK</div>

  </div>



<script>

    function error_msg(error2){
      document.getElementById("error2").classList.toggle("active");
      document.getElementById("popup-2").classList.remove("active");
    } 

    function showsort() {
      document.getElementById("sortdrop").classList.toggle("show");
    }

    
    function togglePop_newadd(){
      document.getElementById("popup-2").classList.toggle("active");
    }


    function showPreview(event){
         if(event.target.files.length > 0){
             var src = URL.createObjectURL(event.target.files[0]);
             var preview = document.getElementById("file-ip-1-preview");
             preview.src = src;
             preview.style.display = "block";
             document.getElementById("popup-2").classList.add("popup_add_new_size");
             document.getElementById("popup-2-content").classList.add("content_add_new_size");
             
         }
    }



    function showPreview_2(event){
         if(event.target.files.length > 0){
             var src = URL.createObjectURL(event.target.files[0]);
             var preview = document.getElementById("file-ip-2-preview");
             preview.src = src;
             preview.style.display = "block";
             document.getElementById("popup-1").classList.add("popup_add_new_size");
             document.getElementById("popup-1-content").classList.add("content_add_new_size");
      
         }
    }


    function filterFunction() {
      var input, filter, ul, li, a, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      div = document.getElementById("sortdrop");
      a = div.getElementsByTagName("a");
      for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                 a[i].style.display = "";
            } else {
                 a[i].style.display = "none";
        }
      }
    }

///////////////////////////////////////Add////////////////////
    var survey_options = document.getElementById('survey_options');
    var add_more_fields = document.getElementById('add_more_fields');
    var remove_fields = document.getElementById('remove_fields');

    add_more_fields.onclick = function(){
      var input_tags = survey_options.getElementsByTagName('input');
      if(input_tags.length < 2){
        var newField = document.createElement('input');
	      newField.setAttribute('type','text');
	      newField.setAttribute('class','inp');
        newField.setAttribute('name','num1[]');
        newField.setAttribute('id','add-number')
       
        survey_options.appendChild(newField);
      }
	    
    }

    remove_fields.onclick = function(){
	    var input_tags = survey_options.getElementsByTagName('input');
      if(input_tags.length > 1) {
		    survey_options.removeChild(input_tags[(input_tags.length) - 1]);
        
	    }
    }

</script>


<?php

  if(isset($_POST['insert_i_c_n'])){

    include '../Model/connect.php';

    $number = count($_POST["num1"]); 
    $flag = 0;
        
    $regex = '/^(?:0|94|\+94)?(?:(?P<area>11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(?P<land_carrier>0|2|3|4|5|7|9)|7(?P<mobile_carrier>0|1|2|4|5|6|7|8)\d)\d{6}$/';  
    
    if($number >0){
      for($i=0; $i<$number; $i++){
        if(preg_match_all($regex, $_POST['num1'][$i], $matches, PREG_SET_ORDER, 0)==false){
          $flag=1;

        }
    }
    }



    if($flag==0){
      $_moderate_area = $_SESSION['moderate_area'];

        $last_value_sql = "SELECT Contact_ID FROM important_number ORDER BY Contact_ID DESC LIMIT 1";
        $last_value_statement = $conn -> query($last_value_sql);
        $last_value_results = $last_value_statement->fetchAll(PDO::FETCH_ASSOC);
        
        if($last_value_results){
            foreach($last_value_results as $last_value_result){
               $connect = substr($last_value_result['Contact_ID'],7)+1;
               $ID = "NL-ICN-".$connect;
               
            }
       }    
    
        
       
        $stmt = $conn->prepare("INSERT INTO `important_number` VALUES(?,?,?,?)");
        $stmt->execute([$ID,$_POST['ic_title'],$_moderate_area, file_get_contents($_FILES['upload']['tmp_name'])]);
        
        if ($number > 0){
            for($i=0; $i<$number; $i++){
                $stmt = $conn->prepare("INSERT INTO `important_number_list` VALUES(?,?)");
                $stmt->execute([$ID,$_POST['num1'][$i]]);
            }
        }
        echo '<script type="text/javascript">window.open("../view/Moderator_Manage_ICN.php", "_self");</script>';
        

    }
    
    else{
        echo '<script type="text/javascript">error_msg();</script>';        
    }

  }


  if(isset($_POST['update_i_c_n'])){

    include '../Model/connect.php';

    $ID = $_SESSION['ICN-ID'];
    $ic_update_title = $_POST["ic_update_title"]; 
    $_moderate_area = $_SESSION['moderate_area'];
    $num1 = $_POST["num1"];  
    $num2 = $_POST["num2"]; 
    
    $flag = 0;
        
    $regex = '/^(?:0|94|\+94)?(?:(?P<area>11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|912)(?P<land_carrier>0|2|3|4|5|7|9)|7(?P<mobile_carrier>0|1|2|4|5|6|7|8)\d)\d{6}$/';  
    
    
    if(preg_match_all($regex,$num1, $matches, PREG_SET_ORDER, 0)==true){

        $query = "DELETE FROM important_number WHERE Contact_ID = :ID";
        $query_statement = $conn->prepare($query);
        $query_statement->bindParam(':ID',$ID,PDO::PARAM_STR);
        $query_statement->execute();
        

        $stmt = $conn->prepare("INSERT INTO `important_number` VALUES(?,?,?,?)");
        $stmt->execute([$ID,$ic_update_title,$_moderate_area, file_get_contents($_FILES['update_upload']['tmp_name'])]);
        
        
        $stmt_num = $conn->prepare("INSERT INTO `important_number_list` VALUES(?,?)");
        $stmt_num->execute([$ID,$num1]);
        
    }
    else{
      echo '<script type="text/javascript">error_msg();</script>'; 
    }

    if(preg_match_all($regex,$num2, $matches, PREG_SET_ORDER, 0)==true){

        $stmt_num = $conn->prepare("INSERT INTO `important_number_list` VALUES(?,?)");
        $stmt_num->execute([$ID,$num2]);
    
    }             
    else if($num2 != ""){
      echo '<script type="text/javascript">error_msg();</script>'; 
    }
  
    echo '<script type="text/javascript">window.open("../view/Moderator_Manage_ICN.php", "_self");</script>';
    
}
?>
    
</body>
</html>