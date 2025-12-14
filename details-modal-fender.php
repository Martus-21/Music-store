<?php

global $db, $z, $row;
require_once 'data/init.php';
include_once 'user_login.php';
$sql ="SELECT * FROM products WHERE featured='1'";
$query = mysqli_query($db,$sql);
while($z = mysqli_fetch_assoc($query)):


//$featured = $db->query($sql);
//$z = mysqli_fetch_assoc($featured);


?>
<div class="modal fade details-<?= $z['id'] ?>" id="details-<?= $z['id'] ?>" tableindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" id="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center"><?= $z['name']; ?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6"
                        <div class="center-block">
                            <img src="<?= $z['image']; ?>" alt="<?= $z['name']; ?>" id="img-size" class="details img-responsive"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>Info</h4>

                        <p><?= $z['description']; ?></p>
                        <hr />
                        <p>
                            <?= $z['price']; ?>
                        </p>
                        <form action="addcard.php" method="post">
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label for="quantity" id="quantity-label">Quantity:</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" />
                                </div>
                            </div>

                            </div>


                    </div>
                </div>



            <div class="modal-footer">
                <!--<button class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Close</button>--!>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span>To Cart</button>
            </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>




