<?php

require_once 'data/init.php';
global $db;
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
            <a class="btn btn-warning mr-2" href="register.php" role="button">Sign up</a>

        </div>
    </div>
</nav>
<div>
    <br/>
</div>
<div id="reg-title">
    <h2>Login</h2>
</div>
<br/>
<div id="registration">
    <form action="log.php" method="POST" id="reg-title">
        <br/>
        <label for="name">Name:</label><br>
        <input type='text' name='name' id="name" required/>
        <br/>
        <label for="password">Password:</label><br>
        <input type='password' name='password' id="password" required/>
        <br/> <br/>
        <input type="submit" name="submit" id="enter">
    </form>
</div>
</body>
</html>
