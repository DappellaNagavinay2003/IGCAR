<?php
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $errors = [];

    if (strlen($input_username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }

    if (strlen($input_password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if ($input_password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }


    $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);


    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $input_username, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

 
    mysqli_stmt_close($stmt);
}


mysqli_close($conn);
?>
