---
layout: default
title: Wedding Registry
permalink: /wedding-success
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

                // Check if image file is an actual image or fake image
                if(!empty($_FILES["image"]["name"])) {

                    $directory = "uploads/";
                    $image = test_input(preg_replace('/\s+/', '', $_POST["name1"])) . basename($_FILES["image"]["name"]);
                    $image = test_input($image);
                    $imagefull = $directory . $image;

                    $imageFileType = pathinfo($imagefull,PATHINFO_EXTENSION);

                    if(getimagesize($_FILES["image"]["tmp_name"]) == false) {
                        array_push($err, "<p class='text-danger'>Sorry, there was something wrong with your image file.</p>");
                    } 
                    // Check if file already exists
                    else if (file_exists($imagefull)) {
                        array_push($err, "<p class='text-danger'>Sorry, we already have an image by that name. Please rename your image.</p>");
                    }
                    // Check file size
                    else if ($_FILES["image"]["size"] > 500000) {
                        array_push($err, "<p class='text-danger'>Sorry, your image is too large.</p>");
                    }
                    // Allow certain file formats
                    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                        array_push($err, "<p class='text-danger'>Sorry, only JPG, JPEG, PNG & GIF images are allowed.</p>");
                    }
                    // upload file
                    else if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagefull)) {
                        $success += 1;
                    } 
                    else {
                        array_push($err, "<p class='text-danger'>Sorry, there was an error uploading your image.</p>");
                    }
                } else {
                    $image = "notavailable.png";
                        $success += 1;
                }


                $name1 = $name2 = $weddingdate = $email = $password = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // filter email and names
                    $name1 = test_input($_POST["name1"]);
                    $name2 = test_input($_POST["name2"]);
                    $weddingdate = test_input($_POST["weddingdate"]);
                    $email = test_input($_POST["email"]);
                    $password = test_input($_POST["password2"]);

                    if (!preg_match("/^[a-zA-Z ]*$/",$name1) || !preg_match("/^[a-zA-Z ]*$/",$name2)) {
                        array_push($err, "<p class='text-danger'>Only letters and white space allowed for names.</p>"); 
                    }
                    
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

                    $servername = "45.40.164.16";
                    $username = "sdweddingreg";
                    $connpassword = "Sd%w3dd1ng";
                    $dbname = "sdweddingreg";
                    $tablename = "registeredcouples";

                    // Create connection
                    $conn = new mysqli($servername, $username, $connpassword, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later</p>";
                        return false;
                    }

                    $sql = "INSERT INTO `sdweddingreg`.`registeredcouples` (`name1`, `name2`, `email`, `image`, `weddingdate`, `date`, `password`) VALUES ('" . $name1. "', '" . $name2 . "', '" . $email . "', '" . $image . "', '" . $weddingdate . "', CURRENT_TIMESTAMP, '" . $password . "');";

                    if ($conn->query($sql) === TRUE) {
                        $success += 1;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
                        return false;
                    }

                }

                if ($success == 2) {
                    echo "<p class='lead'>Thank you for registering with Service Drug! <a href='wedding-couples.php'>View registered couples here.</a></p>";
                }

            }

            ?>

            {% endraw %}

        </div>
    </div>
</div>