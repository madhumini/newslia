<?php

function Most_Recent($Type){
    
    include '../Model/connect.php';
    $Most_Recent_Info = array();
    $Most_Recent_Img = array();
    $Most_Recent_Title = array();
    $Most_Recent_ID = array();

    if($Type == "Articles"){
        $sql_most_popular = "SELECT Post_ID,Image,Title FROM articles ORDER BY Publish_Date DESC LIMIT 5";
    }
    else if($Type == "Ads"){
        $sql_most_popular = "SELECT Post_ID,Image,Title FROM com_ads ORDER BY Publish_Date DESC LIMIT 5";
    }
    else if($Type == "Vacancies"){
        $sql_most_popular = "SELECT Post_ID,Image,Title FROM job_vacancies ORDER BY Publish_Date DESC LIMIT 5";
    }
    else if($Type == "News"){
        $sql_most_popular = "SELECT Post_ID,Image,Title FROM news ORDER BY Publish_Date DESC LIMIT 5";
    }


    $statement_most_popular = $conn->query($sql_most_popular);
    $results_most_popular = $statement_most_popular->fetchAll(PDO::FETCH_ASSOC);

    if($results_most_popular){
        $i = 0;
        foreach($results_most_popular as $result_most_popular){
               $Most_Recent_Img[$i] = $result_most_popular['Image'];
               $Most_Recent_Title[$i] = $result_most_popular['Title'];
               $Most_Recent_ID[$i] = $result_most_popular['Post_ID'];
               $Most_Recent_Info[$i] = pathinfo($result_most_popular['Post_ID'], PATHINFO_EXTENSION);
               $i++;
        }

        echo "
        <h4 class = 'Title_slider'>Most Recent</h4>
        <div class='slider'>
            <div class='slides'>";
                $Count_Slider = count($Most_Recent_Info);
                for ($x = 0; $x < $Count_Slider; $x++) {
                    echo "<input type='radio' name='radio-btn' id = 'radio".($x+1)."'>";
                } 
                
            echo "<div class='slide first'>
                    <img src='data:image/".$Most_Recent_Info[0].";base64,".base64_encode($Most_Recent_Img[0])."'/>
                    <div class='text-wrap'>";

                        if($Type == "Articles"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[0]','ARTICLES');><u>".$Most_Recent_Title[0]."</u></h3>";
                        }
                        else if($Type == "Ads"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[0]','C.ADS');><u>".$Most_Recent_Title[0]."</u></h3>";
                        }
                        else if($Type == "Vacancies"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[0]','VACANCIES');><u>".$Most_Recent_Title[0]."</u></h3>";
                        }
                        else{
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[0]','NEWS');><u>".$Most_Recent_Title[0]."</u></h3>";
                        }
                        

                    echo "</div>
                </div>";

            echo "<div class='slide'>";
                $Count_Slider = count($Most_Recent_Info);        
                for ($x = 1; $x < $Count_Slider; $x++) {
                    echo "<img src='data:image/".$Most_Recent_Info[$x].";base64,".base64_encode($Most_Recent_Img[$x])."'/>
                    <div class='text-wrap'>";
                    
                        if($Type == "Articles"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[$x]','ARTICLES');><u>".$Most_Recent_Title[$x]."</u></h3>";
                        }
                        else if($Type == "Ads"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[$x]','C.ADS');><u>".$Most_Recent_Title[$x]."</u></h3>";
                        }
                        else if($Type == "Vacancies"){
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[$x]','VACANCIES');><u>".$Most_Recent_Title[$x]."</u></h3>";
                        }
                        else{
                            echo "<h3 onclick=toggle_view('$Most_Recent_ID[$x]','NEWS');><u>".$Most_Recent_Title[$x]."</u></h3>";
                        }
                        
                    echo "</div>";
                } 
            echo "</div>";
    
            /*echo "<div class='navigation-auto'>";
                $Count_Slider = count($Most_Recent_Info);
                for ($x = 0; $x < $Count_Slider; $x++) {
                    echo "<div class='auto-btn".($x+1)."'></div>";
                } 


            echo "</div>*/
            echo "</div>

            <div class='navigation-manual'>";
                $Count_Slider = count($Most_Recent_Info);
                    
                for ($x = 0; $x < $Count_Slider; $x++) {
                    echo "<label for='radio".($x+1)."' class='manual-btn'></label>";
                } 
            echo "</div>
	    </div>
        ";


   }


   /*echo "<script type='text/javascript'>
        var counter = 1;
        setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter > ".$Count_Slider."){
                counter = 1;
            }
            },5000);    
        </script>";
    */



}




function Most_Popular($Type){
    
    include '../Model/connect.php';
    $Most_Popular_Info = array();
    $Most_Popular_Img = array();
    $Most_Popular_Title = array();
    $Most_Popular_ID = array();

    if($Type == "Articles"){
        $sql_most_popular_data = "SELECT articles.Post_ID as ID, articles.Image as IMG, articles.Title as TITLE FROM articles INNER JOIN read_time ON articles.Post_ID = read_time.Post_ID ORDER BY read_time.Opening_Time DESC LIMIT 5";
    }
    else if($Type == "Vacancies"){
        $sql_most_popular_data = "SELECT job_vacancies.Post_ID as ID, job_vacancies.Image as IMG, job_vacancies.Title as TITLE FROM job_vacancies INNER JOIN read_time ON job_vacancies.Post_ID = read_time.Post_ID ORDER BY read_time.Opening_Time DESC LIMIT 5";
    }
    else if($Type == "Ads"){
        $sql_most_popular_data = "SELECT com_ads.Post_ID as ID, com_ads.Image as IMG, com_ads.Title as TITLE FROM com_ads INNER JOIN read_time ON com_ads.Post_ID = read_time.Post_ID ORDER BY read_time.Opening_Time DESC LIMIT 5";
    }
    else if($Type == "News"){
        $sql_most_popular_data = "SELECT news.Post_ID as ID, news.Image as IMG, news.Title as TITLE FROM news INNER JOIN read_time ON news.Post_ID = read_time.Post_ID ORDER BY read_time.Opening_Time DESC LIMIT 5";
    }

    $statement_most_popular_data = $conn->query($sql_most_popular_data);
    $results_most_popular_data  = $statement_most_popular_data->fetchAll(PDO::FETCH_ASSOC);

    if($results_most_popular_data){
        
        $i = 0;
        foreach($results_most_popular_data as $result_most_popular_data){
               $Most_Popular_Img[$i] = $result_most_popular_data['IMG'];
               $Most_Popular_Title[$i] = $result_most_popular_data['TITLE'];
               $Most_Popular_ID[$i] = $result_most_popular_data['ID'];
               $Most_Popular_Info[$i] = pathinfo($result_most_popular_data['ID'], PATHINFO_EXTENSION);
               $i++;
        }

        echo "
        <h4 class = 'Title_slider'>Most Popular</h4>
        <div class='slider'>
            <div class='slides'>";
                $Count_Slider_Popular = count($Most_Popular_Info);
                for ($x = 0; $x < $Count_Slider_Popular; $x++) {
                    echo "<input type='radio' name='radio-btn' id = 'radio-popular".($x+1)."'>";
                } 
                
            echo "<div class='slide second'>
                    <img src='data:image/".$Most_Popular_Info[0].";base64,".base64_encode($Most_Popular_Img[0])."'/>
                    <div class='text-wrap'>";
                        if($Type == "Articles"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[0]','ARTICLES');><u>".$Most_Popular_Title[0]."</u></h3>";
                        }
                        else if($Type == "Ads"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[0]','C.ADS');><u>".$Most_Popular_Title[0]."</u></h3>";
                        }
                        else if($Type == "Vacancies"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[0]','VACANCIES');><u>".$Most_Popular_Title[0]."</u></h3>";
                        }
                        else{
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[0]','NEWS');><u>".$Most_Popular_Title[0]."</u></h3>";
                        }
                    echo "</div>
                </div>";

            echo "<div class='slide'>";
                $Count_Slider_Popular = count($Most_Popular_Info);      
                for ($x = 1; $x < $Count_Slider_Popular; $x++) {
                    echo "<img src='data:image/".$Most_Popular_Info[$x].";base64,".base64_encode($Most_Popular_Img[$x])."'/>
                    <div class='text-wrap'>";
                    
                        if($Type == "Articles"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[$x]','ARTICLES');><u>".$Most_Popular_Title[$x]."</u></h3>";
                        }
                        else if($Type == "Ads"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[$x]','C.ADS');><u>".$Most_Popular_Title[$x]."</u></h3>";
                        }
                        else if($Type == "Vacancies"){
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[$x]','VACANCIES');><u>".$Most_Popular_Title[$x]."</u></h3>";
                        }
                        else{
                            echo "<h3 onclick=toggle_view('$Most_Popular_ID[0]','NEWS');><u>".$Most_Popular_Title[$x]."</u></h3>";
                        }
                    echo "</div>";
                } 
            echo "</div>";
    
           /* echo "<div class='navigation-auto'>";
                $Count_Slider_Popular = count($Most_Popular_Info);
                for ($x = 0; $x < $Count_Slider_Popular; $x++) {
                    echo "<div class='auto-btn-popular".($x+1)."'></div>";
                } 


            echo "</div>*/
            echo "</div>

            <div class='navigation-manual'>";
                $Count_Slider_Popular = count($Most_Popular_Info);
                    
                for ($x = 0; $x < $Count_Slider_Popular; $x++) {
                    echo "<label for='radio-popular".($x+1)."' class='manual-btn'></label>";
                } 
            echo "</div>
	    </div>
        ";


   }


   /*echo "<script type='text/javascript'>
        var counter = 1;
        setInterval(function(){
            document.getElementById('radio-popular' + counter).checked = true;
            counter++;
            if(counter > ".$Count_Slider_Popular."){
                counter = 1;
            }
            },5000);    
        </script>";
    */
}
