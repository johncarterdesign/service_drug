---
layout: default
title: Wedding Registry Gift Form
permalink: /wedding-gift-success
---

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            {% raw %}

            <?php
            
            $coupleid = $_GET["id"];

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(isset($_POST["submit"])) {

                $err = array();
                $success = 0;

                $name = $amount = $email = $phone = $address1 = $address2 = $city = $state = $zip = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // filter email and names
                    $name = test_input($_POST["name"]);
                    $amount = test_input($_POST["amount"]);
                    $email = test_input($_POST["email"]);
                    $phone = test_input($_POST["phone"]);
                    $address1 = test_input($_POST["address1"]);
                    $address2 = test_input($_POST["address2"]);
                    $city = test_input($_POST["city"]);
                    $state = test_input($_POST["state"]);
                    $zip = test_input($_POST["zip"]);

                    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                        array_push($err, "<p class='text-danger'>Only letters and white space allowed for name</p>"); 
                    }

                    if (!preg_match("/^[0-9]*$/",$amount)) {
                        array_push($err, "<p class='text-danger'>Only whole dollar amounts allowed</p>"); 
                    }
                    
                    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($err, "<p class='text-danger'>Invalid email.</p>"); 
                    }

                    if (!preg_match("/^[0-9-() ]*$/",$phone)) {
                        array_push($err, "<p class='text-danger'>Invalid phone number</p>"); 
                    }

                    if (!preg_match("/^[A-Za-z0-9.# ]*$/",$address1)) {
                        array_push($err, "<p class='text-danger'>Invalid address</p>"); 
                    }

                    if (!preg_match("/^[A-Za-z0-9.# ]*$/",$address2)) {
                        array_push($err, "<p class='text-danger'>Invalid address</p>"); 
                    }

                    if (!preg_match("/^[A-Za-z0-9.# ]*$/",$address2)) {
                        array_push($err, "<p class='text-danger'>Invalid address</p>"); 
                    }

                    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
                        array_push($err, "<p class='text-danger'>Only letters and white space allowed for city</p>"); 
                    }

                    if (!preg_match("/^[a-zA-Z ]*$/",$state)) {
                        array_push($err, "<p class='text-danger'>Only letters and white space allowed for state</p>"); 
                    }

                    if (!preg_match("/^[0-9-() ]*$/",$zip)) {
                        array_push($err, "<p class='text-danger'>Invalid zip code</p>"); 
                    }

                }

                if (count($err) != 0) {
                    foreach ($err as $message) {
                        echo $message;
                    }
                    return false;
                } else {

                    $servername = "45.40.164.16";
                    $username = "sdweddingreg";
                    $connpassword = "Sd%w3dd1ng";
                    $dbname = "sdweddingreg";
                    $tablename = "contributions";

                    // Create connection
                    $conn = new mysqli($servername, $username, $connpassword, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later</p>";
                        return false;
                    }
                    
                    $sql = "INSERT INTO `sdweddingreg`.`contributions` (`coupleid`, `name`, `amount`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`, `date`) VALUES ('" . $coupleid . "', '" . $name . "', '" . $amount . "', '" . $email . "', '" . $phone . "', '" . $address1 . "', '" . $address2 . "', '" . $city . "', '" . $state . "', '" . $zip . "', CURRENT_TIMESTAMP);";

                    if ($conn->query($sql) === TRUE) {
                        $success += 1;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                        return false;
                    }

                }

                if ($success == 1) {
                    echo "<p class='lead'>Thank you! We will send you a bill shortly. <a href='wedding-couples.php'>Click here to return to couples list.</a></p>";
                }

            }

            ?>

            {% endraw %}

        </div>
    </div>
</div>