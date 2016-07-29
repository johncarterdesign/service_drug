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

    $servername = "68.178.143.9";
    $username = "servicedrugadmin";
    $password = "Sd%4dm1n";
    $dbname = "servicedrugadmin";
    $tablename = "users";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
        return false;
    } 

    $sql = "SELECT * 
FROM  `" . $tablename . "` 
WHERE email =  '" . $inputemail . "'
LIMIT 0 , 30";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['admin-session-set'] = true;
            $_SESSION['email'] = $row["email"];
            $_SESSION['password'] = $row["password"];
            header('Location: index.php');
        }
    } else {
            header('Location: login.php?failure=true');
    }
}
?>