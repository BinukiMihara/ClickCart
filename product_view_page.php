<?php 
    require './conn.php'; 
    $pID = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Cart</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/product_view_page.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Oswald:wght@200&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include "./header.php" ?>

    <?php
        $query = "SELECT *FROM product WHERE product_ID = $pID";
        $result = $con->query($query);
        $row = $result->fetch_assoc();
        $nM = $row['product_Name'];
        $description = $row['product_Description'];

        $stars = array(1, 2, 3, 4, 5);
        $count = array();
        $total = 0;
        foreach ($stars as $star) {
                $query4 = "SELECT * FROM rating WHERE product_ID = $pID AND stars = $star";
                $result4 = $con->query($query4);

                $count[$star] = $result4->num_rows;
                $total += 	$count[$star];			    			
            }

            $a = $result4->num_rows;
            
            $calstar = (1 * $count[1] + 2 * $count[2] + 3 * $count[3] + 4 * $count[4] + 5 * $count[5]);

            if($calstar == 0) {
                $rate = 0;
            } else {
                $rate = $calstar / $total;
            }
   
    ?>

        <div class="section">
            <div>
                    <img class="product_image" src="./images/product/<?php echo $row['product_Image'] ?>">
            </div>

            <div>
                    <p class="product_title"><?php echo $nM; ?></p><br/>
                    <p class="product_des"><?php echo $description; ?></p><br/>
            </div>

            <div class="ratings">
            <span id="stars" class="<?php if($rate >= 1) {echo "fa fa-star checked";} else if (0 < $rate and $rate < 1) {echo "fa fa-star-half-alt";} else {echo "far fa-star";} ?>"></span>
							<span id="stars" class="<?php if($rate >= 2) {echo "fa fa-star checked";} else if (1 < $rate and $rate < 2) {echo "fa fa-star-half-alt";} else {echo "far fa-star";} ?>"></span>
							<span id="stars" class="<?php if($rate >= 3) {echo "fa fa-star checked";} else if (2 < $rate and $rate < 3) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
							<span id="stars" class="<?php if($rate >= 4) {echo "fa fa-star checked";} else if (3 < $rate and $rate < 4) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
							<span id="stars" class="<?php if($rate >= 5) {echo "fa fa-star checked";} else if (4 < $rate and $rate < 5) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
            
                <a href="#">&nbsp;&nbsp;<?php echo $a; ?> Ratings</a>
            </div>

            <div class="brand">Brand : HP</div>
            <div class="price"><?php echo $row['product_Price'] ?></div>
            <!--<div class="discount"><s>$599.00</s>&nbsp;&nbsp;&nbsp;&nbsp;20% OFF</div>-->
            <form action="placeorder.php?pId=<?php echo $pID; ?>" method="POST">
                <div class="quantity">
                    <p>Quantity : </p>
                    <input type="number" min="1" max="10" name="quantity" value="1">
                </div>

                <div class="btn-box">
                        <button class="buy-btn" name="buy_now">Buy Now</button>
            </form>
                    <button class="cart-btn">Add to cart</button>
                </div>
            </br>

            <div class="delivery-description">
                <div class="delivery-box">
                    <p><span style="font-size: medium;"><b>Delivery</b></span></p>
                    <p>There are many variations of passages of Lorem Ipsum available, 
                    but the majority have suffered alteration in some form, by injected humour</p>
                </div>
            </div>

            <div class="delivery-description">
                <div class="delivery-box">
                    <p><span style="font-size: medium;"><b>Standard Delivery</b></span></p>
                    <p>There are many variations of passages of Lorem Ipsum available, 
                    but the majority have suffered alteration in some form, by injected humour</p>
                </div>
            </div>

            <div class="delivery-description">
                <div class="delivery-box">
                    <p><span style="font-size: medium;"><b>Services</b></span></p>
                    <p>There are many variations of passages of Lorem Ipsum available, 
                    but the majority have suffered alteration in some form, by injected humour</p>
                </div>
            </div>

            <div class="delivery-description">
                <div class="delivery-box">
                    <p><span style="font-size: medium;"><b>Sold by</b></span></p>
                    <p>There are many variations of passages of Lorem Ipsum available, 
                    but the majority have suffered alteration in some form, by injected humour</p>
                </div>
            </div>
            </div>

            <div class="rating-section">

                <h2><?php echo $rate; ?> </h2>
                <div>

							<span id="stars" class="<?php if($rate >= 1) {echo "fa fa-star checked";} else if (0 < $rate and $rate < 1) {echo "fa fa-star-half-alt";} else {echo "far fa-star";} ?>"></span>
							<span id="stars" class="<?php if($rate >= 2) {echo "fa fa-star checked";} else if (1 < $rate and $rate < 2) {echo "fa fa-star-half-alt";} else {echo "far fa-star";} ?>"></span>
							<span id="stars" class="<?php if($rate >= 3) {echo "fa fa-star checked";} else if (2 < $rate and $rate < 3) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
							<span id="stars" class="<?php if($rate >= 4) {echo "fa fa-star checked";} else if (3 < $rate and $rate < 4) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
							<span id="stars" class="<?php if($rate >= 5) {echo "fa fa-star checked";} else if (4 < $rate and $rate < 5) {echo "fa fa-star-half-alt";} else {echo "far fa-star";}?>"></span>
							
                </div>
                    <div class="rating-num">
                        <p>
                            <span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
                            <span id="stars" class="fa fa-star checked"></span>
                            <span style="margin-left:5px; margin-top: 5px;"><?php echo $count[5]?></span>
                        </p>
                        <p>
                            <span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
                            <span id="stars" class="far fa-star"></span>
                            <span style="margin-left:5px; margin-top: 5px;"><?php echo $count[4]?>
                        </p>
                        <p>
                            <span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="far fa-star"></span>
                            <span id="stars" class="far fa-star"></span> 
                            <span style="margin-left:5px; margin-top: 5px;"><?php echo $count[3]?>
                        </p>
                        <p>
                            <span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="far fa-star"></span>
							<span id="stars" class="far fa-star"></span>
                            <span id="stars" class="far fa-star"></span> 
                            <span style="margin-left:5px; margin-top: 5px;"><?php echo $count[2]?>
                        </p>
                        <p>
                            <span id="stars" class="fa fa-star checked"></span>
							<span id="stars" class="far fa-star"></span>
							<span id="stars" class="far fa-star"></span>
							<span id="stars" class="far fa-star"></span>
                            <span id="stars" class="far fa-star"></span> 
                            <span style="margin-left:5px; margin-top: 5px;"><?php echo $count[1]?>
                        </p>
                    </div>
                </div>

                <div  class="review-1">
                    <p>Product Reviews</p>
                </div>

                
                <?php
                $query4 = "SELECT * FROM rating WHERE product_ID = $pID";
                $result4 = $con->query($query4);
                while ($row4 = $result4->fetch_assoc()) {

                ?>
                <div class="review-2">
                    <p>Date and time</p>
                    <div class="review-image">
                        <img src="./images/comb.jpg">
                    </div>
                    <div class="review-des">
                        <p><?php echo $row4['comment'] ?></p>
                    </div>
                </div>
                <?php } ?>

                







    <?php include "./footer.php" ?> 
</body>
</html>