---
layout: default
title: Wedding Registry Account
permalink: /wedding-couples-account
---

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            {% raw %}

            <?php

            echo "<img class='img-responsive' width='600' src='uploads/" . $_SESSION["image"] . "'>";
            echo "<h1>" . $_SESSION['name1'] . " and " . $_SESSION['name2'] .  "</h1>";
            echo "<p class='lead'>Wedding date: " . date('F j, Y',strtotime($_SESSION["weddingdate"])) . "</p>";

            $servername = "45.40.164.16";
            $username = "sdweddingreg";
            $password = "Sd%w3dd1ng";
            $dbname = "sdweddingreg";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                return false;
            } 

            $sql = "SELECT * 
FROM  `contributions` 
WHERE  `coupleid` = CONVERT( _utf8 '" . $_SESSION['id'] . "'
USING latin1 ) 
COLLATE latin1_swedish_ci
LIMIT 0 , 30";
            $result = $conn->query($sql);

            echo "<h2 style='border-bottom: solid 2px #eee; margin-top: 60px;'>Gifts</h2>";

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='media'>";

                    echo "<div class='media-body'>";

                    echo "<h3 class='media-heading'>" . $row["name"] . "</h3>";

                    echo "<p class='lead text-success' style='margin-bottom:0'>$" . $row["amount"] . "</p>";
                    
                    echo "<a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a>";

                    echo "<address>" . $row["address1"] . "<br>";
                    if ($row["address2"]) {echo $row["address2"] . "<br>"; }
                    echo $row["city"] . ", " . $row["state"] . " " . $row["zip"] . "</address>";

                    echo "</div></div>";
                }
            } else {
                echo "<p class='lead'>No gifts</p>";
            }
            $conn->close();

            ?>

            {% endraw %}

        </div>
    </div>
</div>