<?php
session_start();
?>

<?php

include '../Model/connect.php';

$USERID = $_SESSION['System_Actor_ID'];
$post_Id = $_SESSION['G_DELETE_POST_ID'];
$post_Type = $_SESSION['G_DELETE_POST_TYPE'];
/*
echo "$post_Id";
echo "$post_Type";
echo "$USERID";
*/

//delete drafted article

if ($post_Type == "Article") {
    $sql = 'DELETE FROM articles_drafted WHERE Post_Id = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':G_DELETE_POST_ID' => $post_Id])) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete drafted news

if ($post_Type == "News") {
    $sql = 'DELETE FROM news_drafted WHERE Post_Id = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':G_DELETE_POST_ID' => $post_Id])) {
        echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
    }
}

//delete drafted article from editing

if ($post_Type == "D_A") {
    $sql = 'DELETE FROM articles_drafted WHERE Post_Id = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':G_DELETE_POST_ID' => $post_Id])) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending commercial advertisement

if ($post_Type == "Commercial_Advertisement") {
    $sql = 'DELETE FROM com_ads_drafted WHERE Post_Id = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_Id = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending commercial advertisement from editing

if ($post_Type == "D_CA") {
    $sql = 'DELETE FROM com_ads_drafted WHERE Post_Id = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_Id = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending job vacancy

if ($post_Type == "Job_Vacancy") {
    $sql = 'DELETE FROM job_vacancies_drafted WHERE Post_ID = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_ID = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending job vacancy from editing

if ($post_Type == "D_JV") {
    $sql = 'DELETE FROM job_vacancies_drafted WHERE Post_ID = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_ID = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending notice

if ($post_Type == "Notice") {
    $sql = 'DELETE FROM notices_drafted WHERE Post_ID = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_ID = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


//delete pending notice from editing

if ($post_Type == "D_NO") {
    $sql = 'DELETE FROM notices_drafted WHERE Post_ID = :G_DELETE_POST_ID';
    $statement = $conn->prepare($sql);

    $sql_2 = 'DELETE FROM drafted_post_area WHERE Post_ID = :G_DELETE_POST_ID';
    $statement_2 = $conn->prepare($sql_2);

    if (($statement->execute([':G_DELETE_POST_ID' => $post_Id])) && ($statement_2->execute([':G_DELETE_POST_ID' => $post_Id]))) {
        if($_SESSION['Actor_Type'] == "REPORTER"){
            echo '<script type="text/javascript">window.open("../view/Repoter_Drafted_Post.php", "_self");</script>';
        }
        echo '<script type="text/javascript">window.open("../view/N_User_Drafted_Post.php", "_self");</script>';
    }
}


?>