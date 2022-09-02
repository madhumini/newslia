<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>NEWSLIA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Normal_User/navigation.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/Send-Approve.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico">

    <script src="https://kit.fontawesome.com/c119b7fc61.js" crossorigin="anonymous"></script>
</head>

<style>
    body {
        font-family: 'Sora', sans-serif;
    }

    .profile-menu-container {
        margin-right: 160px;
    }

    .down {
        margin-left: 2px;
    }

    .fa-customize {
        font-size: 22px;
        color: black;
    }

    .write-btn {
        padding: 8px;
        width: 150px;
        border: none;
        outline: none;
        border-radius: 7px;
        margin-left: 20px;
        font-size: 18px;
        cursor: pointer;
    }

    .input-field {
        background-color: #eeeeee;
        padding: 8px;
        border: none;
        outline: none;
        font-size: 15px;
        padding-left: 20px;
        width: 80%;
    }
</style>

<body>

    <!--navigation-->

    <?php $page = 'advertisements';
    include 'nav.php'; ?>

    <!--End of Navigation-Bar-->

    <div style="margin-top: 40px; margin-left: 40px;">

        <form action="N_User_Pending_Posts.php" method="post" enctype="multipart/form-data">
            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Advertisement Type :-</h3>
                </div>
                <div style="width: 80%; ">
                    <input type="text" class="input-field" value="Job Vacancy" name="Advertisement_Type" readonly>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Company Name :-</h3>
                </div>
                <div style="width: 80%; ">
                    <input type="text" class="input-field" name="Company_Name" required>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Position :-</h3>
                </div>
                <div style="width: 80%; ">
                    <input type="text" class="input-field" name="Position" required>
                </div>
            </div>



            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Deadline Date :-</h3>
                </div>
                <div style="width: 80%; ">
                    <input type="date" class="input-field" name="Deadline_Date" required>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Area :-</h3>
                </div>
                <div style="width: 80%; ">
                    <select name="Area" id="" class="input-field">
                        <option value="" disabled selected hidden required>Select Area</option>
                        <?php
                        include '../Model/connect.php';
                        $system_actor_id = $_SESSION['System_Actor_ID'];
                        $reading_area_sql = "SELECT * FROM read_area WHERE (System_Actor_Id = '$system_actor_id') ";

                        $reading_area_statement = $conn->query($reading_area_sql);
                        $reading_area_results = $reading_area_statement->fetchAll(PDO::FETCH_ASSOC);

                        if ($reading_area_results) {
                            foreach ($reading_area_results as $reading_area_result) {
                                echo "<option>" . $reading_area_result['Area'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>



            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Content :-</h3>
                </div>
                <div style="width: 80%;">
                    <div class="container">
                        <div style="width: 95%;">
                            <textarea name="content" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                <div style="width: 20%;">
                    <h3>Add Images :-</h3>
                </div>
                <div style="width: 80%;">
                    <div class="input-field">
                        <input type="file" id="myFile" name="Image" required>
                    </div>
                </div>
            </div>

            <div style=" margin-bottom: 150px; margin-top: 40px; text-align: end; margin-right: 50px; display: flex; justify-content: flex-end;">
                <input type="submit" value="Draft" class="write-btn" style="background-color: #45ADA8EB;" name="D_JV_Submit">
                <div class="write-btn" style="background-color: #00B172EB; text-align: center;" onclick="togglePopup_select_option('select-type')">Send</div>
                <div onclick="togglePopup_select_option('confirm_delete_article')" class="write-btn" style="background-color: #FF4444EB; text-align: center;">Delete</div>
            </div>


    </div>


    <!--Popup One-->

    <div class="popup popup_set_time" id="select-type">

        <div class="overlay"></div>

        <div class="content popup_set_time" style="width: 300px; height: 310px;">
            <div class="close-btn" onclick="togglePopup_select_option('select-type')">&times;</div>

            <div class="content_body popup_set_time_body">
                <div class="popup_logo">
                <img src='../images/Name.svg'>
                </div>

                <hr>

                <div class="popup_form">
                    <h3 class="popup_title">Select Option to Publish</h3>
                    <div class="btn_set_option">
                        <div class="select_option" style="text-align: center;" onclick="togglePopup_select_option('set-time'); hide_previous('select-type')">
                            <p style="font-size: 15px;">Set Time</p>
                        </div>
                        <input type="submit" name="Pending_JV_Without_Time_Submit" value="Publish Now" class="select_option" style="border: none; font-size: 15px;">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Second Popup-->

    <div class="popup popup_set_time" id="set-time">

        <div class="overlay"></div>

        <div class="content popup_set_time" style="width: 300px; height: 310px;">
            <div class="close-btn" onclick="togglePopup_select_option('set-time'); hide_previous('select-type')">&times;</div>


            <div class="content_body popup_set_time_body">
                <div class="popup_logo">
                <img src='../images/Name.svg'>
                </div>
                <hr>

                <div class="popup_form">
                    <h3 class="popup_title">Set Time to Publish</h3>



                    <label for="new-date" class="lbl"> Date</label>
                    <input type="date" name="Set_Date" id="new-date" class="inp inp1" value="2022-01-17" required>
                    <br>
                    <br>

                    <label for="new-time" class="lbl"> Time</label>

                    <input type="time" name="Set_Time" id="new-time" class="inp inp1" value="00:00" required>
                    <br>
                    <!--<div class="update_btn" onclick="window.open('N_User_Pending_Posts.php','_self')">Set</div>-->
                    <input type="submit" value="Set" name="Pending_JV_With_Time_Submit" class="update_btn" style="border: none;">


                </div>

            </div>
        </div>

    </div>


    <!-- delete popup-->

    <div class="navigation-popup  navigation-popup_set_time" id="confirm_delete_article">
        <div class="navigation-overlay"></div>
        <div class="navigation-content  navigation-popup_set_time" style="width: 300px; height: 280px;">
            <div class="navigation-content_body  navigation-popup_set_time_body">
                <div class="navigation-popup_logo">
                <img src='../images/Name.svg'>
                </div>

                <hr>

                <div class="navigation-popup_form">
                    <h3 class="navigation-popup_title" style="text-align: center;">Sure to Delete</h3>
                    <div class="navigation-btn_set_option">

                        <div class="navigation-select_option" onclick="window.open('./Moderator_View_Jobs.php','_self')" style="text-align: center; font-weight: bold; background-color: #FF4444EB;">Yes</div>
                        <div class="navigation-select_option" onclick="togglePopup_select_option('confirm_delete_article')" style="text-align: center; font-weight: bold;">No</div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    </form>

</body>

<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

<!--Popup-->

<script>
    function togglePopup_select_option(id) {
        document.getElementById(id).classList.toggle("active");
    }

    function hide_previous(id) {
        document.getElementById(id).classList.toggle("navigation-hide");
    }
</script>

</html>