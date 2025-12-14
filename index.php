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
<?php
    $sql = "SELECT * FROM categories WHERE parent = 0";
    $a = $db->query($sql);
?>
<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a href="/Project_01/index.php" class="navbar-brand" id="text">Music store</a>

        <div class="d-flex">
            <?php

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
            <a class="btn btn-success mr-2" href="login.php" role="button">Login</a>
            <a class="btn btn-warning mr-2" href="register.php" role="button">Sign up</a>
            <form class="d-flex input-group w-auto" method="post">
                <input
                        type="search"
                        name="search"
                        class="form-control rounded"
                        placeholder="Search"
                        aria-label="Search"
                        aria-describedby="search-addon"
                />
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </form>
        </div>
    </div>
</nav>
<div>
    <br/>
</div>
<div class="container" >
    <div class="row align-items-start">
        <div class="col">
            Welcome to our new MUSIC STORE!
        </div>
    </div>
    <br/>
<div class="hero-image">

    <div id="image-1"></div>
    <div id="image-2"></div>

<div class="d-flex justify-content-center">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/fender logo.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/piano_logo.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/Marshall_logo.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
<div>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
</div>
<br/>

    <?php
    $con = new PDO("mysql:host=localhost;dbname=music_store1", "root", "");
    if (isset($_POST["search"])) {
        $str = $_POST["search"];
        echo "Results for " . $str;
        $sth = $con->prepare("SELECT * FROM products WHERE name LIKE '%$str%'");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $sth->execute();
        if($row = $sth->fetch()) {

            ?>
            <div class="col-md-3">
                <h4><?= $row->name; ?></h4>
                <img src="<?= $row->image; ?>" alt="<?= $row->image; ?>" id="images"/>
                <p class="list-price text-danger">List Price: <s><?= $row->list_price; ?></s></p>
                <p class="price">Our Price: <?= $row->price; ?></p>
                <button type="button" class="btn btn-success" disabled="true" data-bs-toggle="modal" data-bs-target="#no-registration">Details</button>
            </div>
            <br><br><br>


            <?php
        }

        else {
    ?>
    <br>
    <?php
            echo " No results found";
    }

    }
    ?>

<!--list of instruments-->
<div class="col-md-15">
    <div class="row">
        <h2 class="text-center">Instruments</h2>
        <hr/>
        <?php while ($product = mysqli_fetch_assoc($featured)) :  ?>

        <div class="col-md-3">
            <h4><?= $product['name']; ?></h4>
            <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" id="images"/>
            <p class="list-price text-danger">List Price: <s><?= $product['list_price']; ?></s></p>
            <p class="price">Our Price: <?= $product['price']; ?></p>
            <button type="button" class="btn btn-success" disabled="true" data-bs-toggle="modal" data-bs-target="#no-registration">Details</button>
        </div>
        <?php endwhile; ?>

    </div>

        <footer class="text-center" id="footer">&copy; Copyright 2024 Music Store </footer>


</body>
</html>



