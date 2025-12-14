
<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
    $conn=mysqli_connect("localhost","root","","music_store1") or die("Error " .mysqli_connect_error());
    if (isset($_POST["submit"])){
    $name_buy=$_POST["name"];
    $email_buy=$_POST["email"];

        $sql = "INSERT INTO `purchases` (`name_buy`, `email_buy`) VALUES ('$name_buy', '$email_buy')";

        $query = mysqli_query($conn, $sql);
        if($query){
            echo "Purchase successful! Thank you for using Music store!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}