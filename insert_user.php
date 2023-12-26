<?php
include 'db.php';


$username = 'vinay';
$password = password_hash('Dappella', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "User record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
