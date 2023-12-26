<?php
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    $errors = [];

    if (strlen($input_username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }

    if (strlen($input_password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $input_username);
    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($input_password, $row["password"])) {
            echo "Login successful!";
   
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }


    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
