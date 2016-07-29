---
layout: default
title: Wedding Registry Couples
permalink: /wedding-couples
---

<div class="container">
    <div class="row">
        <div class="col-xs-12" style="margin-bottom: 20px">
            
            <p>Click the Send Gift button below to give to a couple's registry. Simply fill out the form and we will bill you! <a href='wedding-couples-login.php'>Click here to log in and view your registry.</a></p>
        
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

            {% raw %}

            <?php

            $servername = "45.40.164.16";
            $username = "sdweddingreg";
            $password = "Sd%w3dd1ng";
            $dbname = "sdweddingreg";
            $tablename = "registeredcouples";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                return false;
            } 

            $sql = "SELECT id, name1, name2, image, weddingdate FROM registeredcouples";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <div class='media'>
                    
                    <div class='media-left'>
                    
                    <img class='media-object' src='uploads/" . $row["image"] . "' alt='' width='300'>
                    
                    </div>
                    
                    <div class='media-body'>
                    
                    <h4 class='h3 media-heading'>" . $row["name1"] . " and " . $row["name2"] . "</h4>
                    
                    <p class='lead' style='margin-bottom:15px'>" . date('F j, Y',strtotime($row["weddingdate"])) . "</p>
                    
                    <a class='btn btn-primary btn-sm' href='wedding-couples-gift.php?id=" . $row["id"] . "'>Send Gift</a>
                    
                    </div>
                    </div>";
                }
            } else {
                echo "<p>0 results</p>";
            }
            $conn->close();


            ?>

            {% endraw %}

        </div>
    </div>
</div>