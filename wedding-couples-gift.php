---
layout: default
title: Wedding Registry Gift Form
permalink: /wedding-couples-gift
---

{% raw %}

<?php

$name1 = $name1 = $image = $weddingdate = "";


$coupleid = $_GET["id"];

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

$sql = "SELECT name1, name2, image, weddingdate FROM registeredcouples WHERE id = " . $coupleid;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name1 = $row["name1"];
        $name2 = $row["name2"];
        $image = $row["image"];
        $weddingdate = $row["weddingdate"];
    }
} else {
    echo "<p>0 results</p>";
}
$conn->close();

?>

{% endraw %}

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">

            {% raw %}

            <?php

            echo "
            <img class='img-responsive' src='uploads/" . $image . "'>

                <h2>" . $name1 . " and " . $name2 . "</h2>
                <p class='lead'>" . date('F j, Y',strtotime($weddingdate)) . "</p>

                <div class='panel panel-default'>

                    <div class='panel-body'>

                        <form action='wedding-gift-success.php?id=" . $coupleid . "' method='post' enctype='multipart/form-data'> 

                            <div class='form-group'>
                                <label for='name'>Name</label>
                                <p class='warning' id='name-warning'></p>
                                <input type='text' name='name' class='form-control' id='name' required>
                            </div>

                            <div class='form-group'>
                                <label for='amount'>Donation amount</label>
                                <p class='warning' id='amount-warning'></p>
                                <div class='input-group'>
                                    <span class='input-group-addon'>$</span>
                                    <input type='text' class='form-control' aria-label='Amount (to the nearest dollar)' name='amount' id='amount' required>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label for='email'>Email</label>
                                <input type='text' name='email' class='form-control' id='email' required>
                            </div>

                            <div class='form-group'>
                                <label for='phone'>Phone number</label>
                                <p class='warning' id='phone-warning'></p>
                                <input type='text' name='phone' class='form-control' id='phone' required>
                            </div>

                            <div class='form-group'>
                                <label for='address1'>Address line 1</label>
                                <p class='warning' id='address1-warning'></p>
                                <input type='text' name='address1' class='form-control' id='address1' required>
                            </div>

                            <div class='form-group'>
                                <label for='address2'>Address line 2</label>
                                <input type='text' name='address2' class='form-control' id='address2'>
                            </div>

                            <div class='form-group'>
                                <label for='city'>City</label>
                                <p class='warning' id='city-warning'></p>
                                <input type='text' name='city' class='form-control' id='city' required>
                            </div>

                            <div class='form-group'>
                                <label for='state'>State</label>
                                <p class='warning' id='state-warning'></p>
                                <input type='text' name='state' class='form-control' id='state' required>
                            </div>

                            <div class='form-group'>
                                <label for='zip'>Zip code</label>
                                <p class='warning' id='zip-warning'></p>
                                <input type='text' name='zip' class='form-control' id='zip' required>
                            </div>

                            <input class='btn btn-primary' type='submit' value='Submit' name='submit' id='submit' style='margin-top: 15px'>
                        </form>

                    </div>

                </div>

            "

            ?>

            {% endraw %}

        </div>
    </div>
</div>


