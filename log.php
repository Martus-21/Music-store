<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "music_store1";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($data, $_POST["name"]);
    $password = mysqli_real_escape_string($data, $_POST["password"]);

    $sql = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = mysqli_query($data, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row["usertype"] == "user") {
            echo "User. Login Successful"; ?>
            <form action="user_login.php" method="POST" id="reg-title">
                <br/>
                <h2>Click the button below to return in the main window</h2>
                <br/>
                <input type="submit" class="btn btn-danger" name="submit" id="submit">
            </form>
            <?php
        } elseif ($row["usertype"] == "admin") {
            echo "Admin. Login Successful"; ?>
            <form action="admin.php" method="POST" id="reg-title">
                <br/>
                <h2>Click the button below to add items</h2>
                <br/>
                <input type="submit" class="btn btn-danger" name="submit" id="submit">
            </form>
            <?php
        }
    } else {
        echo "Login Unsuccessful";
    }
}

mysqli_close($data);
?>