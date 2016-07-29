---
layout: default
title: Service Drug Admin
permalink: /admin/
---

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            <h2>Wedding Registry</h2>

            {% raw %}

            <?php

            // WEDDING REGISTRY
            $servernameWedding = "45.40.164.16";
            $usernameWedding = "sdweddingreg";
            $passwordWedding = "Sd%w3dd1ng";
            $dbnameWedding = "sdweddingreg";

            $connWedding = new mysqli($servernameWedding, $usernameWedding, $passwordWedding, $dbnameWedding);
            if ($connWedding->connect_error) {
                echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                return false;
            } 

            $sqlWeddingcouples = "SELECT * 
            FROM  `registeredcouples` 
            LIMIT 0 , 30";
            function sqlWeddinggifts($id) {
                $gifts = "SELECT * 
                FROM  `contributions`
                WHERE coupleid = " . $id . "
                LIMIT 0 , 30";
                return $gifts;
            }

            $resultWeddingcouples = $connWedding->query($sqlWeddingcouples);

            if ($resultWeddingcouples->num_rows > 0) {
                while($rowWeddingcouples = $resultWeddingcouples->fetch_assoc()) {
                    echo "<h3>" . $rowWeddingcouples["name1"] . " and " . $rowWeddingcouples["name2"] . "</h3>";
                    echo "<p class='lead'>" . $rowWeddingcouples["weddingdate"] . "</p>";
                    $resultWeddinggifts = $connWedding->query(sqlWeddinggifts($rowWeddingcouples["id"]));
                    if ($resultWeddinggifts->num_rows > 0) {
                        echo "<h4>Gifts</h3>";
                        while($rowWeddinggifts = $resultWeddinggifts->fetch_assoc()) {
                            echo "<h5>" . $rowWeddinggifts["name"] . "</h5>";
                            
                            echo "<ul class='list-unstyled'>";
                            
                            echo "<li><span class='lead text-success'>$" . $rowWeddinggifts["amount"] . "</span></li>";
                            echo "<li>" . $rowWeddinggifts["date"] . "</li>";
                            echo "<li>" . $rowWeddinggifts["email"] . "</li>";
                            
                            echo "<li><address>";
                            echo $rowWeddinggifts["phone"] . "<br>";
                            echo $rowWeddinggifts["address1"] . "<br>";
                            if ($rowWeddinggifts["address2"]) { echo $rowWeddinggifts["address2"] . "<br>"; }
                            echo $rowWeddinggifts["city"] . ", " . $rowWeddinggifts["state"] . " " . $rowWeddinggifts["zip"];
                            echo "</li></address>";
                            
                            echo "</ul>";
                        }
                    } else {
                        echo "<p>No gifts</p>";
                    }
                }
            } else {
                echo "<p class='lead'>No registered couples</p>";
            }

            $connWedding->close();

            ?>

            {% endraw %}

        </div>
    </div>
</div>