<?php

$id = $_GET["id"];

// WEDDING REGISTRY
$servername = "45.40.164.16";
$username = "sdweddingreg";
$password = "Sd%w3dd1ng";
$dbname = "sdweddingreg";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<p class='text-danger'>Sorry, there was a problem with your connection. Please try again later.</p>";
    return false;
} 

$sql = "DELETE FROM registeredcouples WHERE id =  '" . $id . "'";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php?deleteSuccess=true');
} else {
    header('Location: index.php?deleteFailure=true');
}

?>