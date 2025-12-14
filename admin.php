<?php
require_once 'data/init.php';
$sql ="SELECT * FROM products WHERE featured='1'";
$featured = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Music store
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<?php
$sql = "SELECT * FROM categories WHERE parent = 0";
$a = $db->query($sql);
?>
<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a href="/Project_01/index.php" class="navbar-brand" id="text">Music store</a>

        <div class="d-flex">
            <?php
            // Fetch all categories in a single query
            $categories = [];
            $sql = "SELECT * FROM categories";
            $result = $db->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[$row['parent']][] = $row;
            }
            ?>

            <?php foreach ($categories[0] as $parent): ?>
                <div class="dropdown show mr-3">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="menu" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($parent['category']); ?>
                    </a>
                    <div class="dropdown-menu">
                        <?php foreach ($categories[$parent['id']] as $child): ?>
                            <a class="dropdown-item" href="#"><?php echo htmlspecialchars($child['category']); ?></a>
                        <?php endforeach; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">How to choose a musical instrument?</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="d-flex">
            <a class="btn btn-danger" href="index.php" role="button">Logout</a>

        </div>
    </div>
</nav>

<div>
    <br/>
</div>
<h1>Hello, admin!</h1>
<br/>
<h1 class="text-center">Add a new instrument</h1>
<div id="registration">
    <form action="additem.php" method="POST" enctype="multipart/form-data" id="reg-title">
        <label for="instrument">Instrument Name:</label><br/>
        <input type="text" name="instrument" id="instrument" required><br>

        <label for="price">Price:</label><br/>
        <input type="number" name="price" id="price" required><br>

        <label for="list_price">List Price:</label><br/>
        <input type="number" name="list_price" id="list_price" required><br>

        <label for="brand">Brand:</label><br/>
        <input type="text" name="brand" id="brand" required><br>

        <label for="categories">Categories:</label><br/>
        <input type="text" name="categories" id="categories" required><br>

        <label for="description">Description:</label><br/>
        <textarea name="description" id="description" required></textarea><br>

        <label for="image">Image:</label><br/>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required><br>
        <br/>
        <input type="submit" name="submit" value="Submit">
    </form>

</div>
