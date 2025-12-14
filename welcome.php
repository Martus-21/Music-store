<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $conn = new mysqli("localhost", "root", "", "music_store1");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (isset($_POST["name"], $_POST["password"], $_POST["email"])) {

        $name = $conn->real_escape_string($_POST["name"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $email = $conn->real_escape_string($_POST["email"]);


        $stmt = $conn->prepare("INSERT INTO `users` (`name`, `password`, `email`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password, $email);


        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }


        $stmt->close();
    } else {
        echo "Required fields are missing.";
    }


    $conn->close();
}
?>