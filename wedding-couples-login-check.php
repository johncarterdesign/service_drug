<?php
if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $inputemail = test_input($_POST["email"]);
    $inputpassword = test_input($_POST["password"]);

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

    $sql = "SELECT * 
FROM  `registeredcouples` 
WHERE  `email` = CONVERT( _utf8 '" . $inputemail . "'
USING latin1 ) 
COLLATE latin1_swedish_ci
AND  `password` = CONVERT( _utf8 '" . $inputpassword . "'
USING latin1 ) 
COLLATE latin1_swedish_ci
LIMIT 0 , 30";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['wedding-couples-session-set'] = true;
            $_SESSION['id'] = $row["id"];
            $_SESSION['name1'] = $row["name1"];
            $_SESSION['name2'] = $row["name2"];
            $_SESSION['weddingdate'] = $row["weddingdate"];
            $_SESSION['date'] = $row["date"];
            $_SESSION['image'] = $row["image"];
        }
        header('Location: wedding-couples-account.php');
    } else {
        header('Location: wedding-couples-login.php?failure=true');
    }
}
?>