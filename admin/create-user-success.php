---
layout: default
title: Service Drug Admin - Create User Success
permalink: /admin/create-user-success
---

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            {% raw %}

            <?php

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(isset($_POST["submit"])) {

                $err = array();
                $success = 0;

                $email = $password = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // filter email and names
                    $email = test_input($_POST["email"]);
                    $password = test_input($_POST["password"]);

                    if (!preg_match("/^\w{5,50}$/",$password)) {
                        array_push($err, "<p class='text-danger'>Password must be at least 6 characters long and cannot contain spaces or the following characters: \$ # % @ & \* \( \) { } \+</p>"); 
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($err, "<p class='text-danger'>Invalid email.</p>"); 
                    }

                }

                if (count($err) != 0) {
                    foreach ($err as $message) {
                        echo $message;
                    }
                    return false;
                } else {

                    $servername = "68.178.143.9";
                    $username = "servicedrugadmin";
                    $connpassword = "Sd%4dm1n";
                    $dbname = "servicedrugadmin";
                    $tablename = "users";

                    // Create connection
                    $conn = new mysqli($servername, $username, $connpassword, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later</p>";
                        return false;
                    }

                    $sql = "INSERT INTO `" . $dbname . "`.`" . $tablename . "` (`email`, `password`) VALUES ('" . $email . "', '" . $password . "');";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p class='lead'>Admin user successfully created! <a href='login.php'>Click here to login</a></p>";
                    } else {
                        // echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                        return false;
                    }

                }

            }

            ?>

            {% endraw %}

        </div>
    </div>
</div>