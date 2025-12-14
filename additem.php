<?php
$str = "images/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $conn = new mysqli("localhost", "root", "", "music_store1");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if (isset($_POST["instrument"], $_POST["price"], $_POST["list_price"], $_POST["brand"], $_POST["categories"], $_POST["description"], $_FILES["image"])) {

        $name = $conn->real_escape_string($_POST["instrument"]);
        $price = $conn->real_escape_string($_POST["price"]);
        $list_price = $conn->real_escape_string($_POST["list_price"]);
        $brand = $conn->real_escape_string($_POST["brand"]);
        $categories = $conn->real_escape_string($_POST["categories"]);
        $description = $conn->real_escape_string($_POST["description"]);


        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_error = $_FILES["image"]["error"];

        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image_mime = mime_content_type($image_tmp_name);

        if ($image_error === 0 && in_array($image_extension, $allowed_extensions) && ($image_mime == 'image/jpeg' || $image_mime == 'image/png')) {
            $image = $str . basename($image_name);


            if (move_uploaded_file($image_tmp_name, $image)) {

                $stmt = $conn->prepare("INSERT INTO `products` (`name`, `price`, `list_price`, `brand`, `categories`, `image`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $name, $price, $list_price, $brand, $categories, $image, $description);


                if ($stmt->execute()) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }


                $stmt->close();
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid image format. Only JPG and PNG are allowed.";
        }
    } else {
        // Debugging output to check which fields are missing
        echo "Required fields are missing. Debug info: <br>";
        echo "instrument: " . (isset($_POST["instrument"]) ? 'set' : 'not set') . "<br>";
        echo "price: " . (isset($_POST["price"]) ? 'set' : 'not set') . "<br>";
        echo "list_price: " . (isset($_POST["list_price"]) ? 'set' : 'not set') . "<br>";
        echo "brand: " . (isset($_POST["brand"]) ? 'set' : 'not set') . "<br>";
        echo "categories: " . (isset($_POST["categories"]) ? 'set' : 'not set') . "<br>";
        echo "description: " . (isset($_POST["description"]) ? 'set' : 'not set') . "<br>";
        echo "image: " . (isset($_FILES["image"]) ? 'set' : 'not set') . "<br>";
    }


    $conn->close();
}
?>