<?php

    require './conn.php';

    session_start();

    $bId = $_SESSION['buyer_ID'];

// Check if the form is submitted
if (isset($_POST['buy_now'])) {


    $productID = $_GET['pId'];
    $q = $_POST['quantity'];

    $sql = "SELECT * FROM product WHERE product_ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()){
        $productName = $row['product_Name'];
        $productPrice = $row['product_Price'];
        $productImage = $row['product_Image'];
    }

    $querybuyer = "SELECT * FROM buyer WHERE buyer_ID = 1 ";
    $resultbuyer = $con->query($querybuyer);
    $row1 = $resultbuyer->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Cart</title>
    <link rel="stylesheet" href="./css/placeorder.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Oswald:wght@200&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
    </script>

</head>

<body>
    <?php include "./header.php" ?>


    <div class="wrapper">
        <div class="left-container">
            <div class="details">
                <form method="POST" action="process_order.php?pId=<?php echo  $productID; ?>" >
                    
                    <h2>Product Name: <?php echo $productName; ?></h2>
                    <img style="width:100px;height:100px;" src="./images/product/<?php echo $productImage; ?>" alt="Product Image">
                    <br>

                    <div class="bla">
                        <label for="des">Delivery Address:</label>
                        <input type="text" name="delivery_address" id="delivery_address" value="<?php echo $row1['address']; ?>" required><br>
                    </div>

                    <div class="bla">
                        <label for="des">Quantity:</label>
                        <input type="text" name="qty" id="qty" value="<?php echo $q; ?>" required><br>
                    </div>
                    
                        <label for="des">Billing address:</label>
                        <input type="text" name="billing_address" id="billing_address" value="<?php echo $row1['address']; ?>" required><br><br>
                    </div>

                    <div class="bla">
                        <label for="des">Email:</label>
                        <input type="email" name="buyer_email" id="buyer_email" value="<?php echo $row1['email']; ?>" required><br>
                    </div>

                    <div class="details4"> Select Payment Method: </div>
                    <div class="items">
                <div class="item"><i class="fa-solid fa-money-bill-1-wave"></i><input type="radio" name="payment_method" id="payment_method"/></div>
                <div class="item"><i class="fa-brands fa-cc-visa"></i><input type="radio" name="payment_method" id="payment_method" /></div>
                <div class="item"><i class="fa-brands fa-cc-mastercard"></i><input type="radio" name="payment_method" id="payment_method" /></div>
                <div class="item"><i class="fa-brands fa-cc-paypal"></i><input type="radio" name="payment_method" id="payment_method" /></div>
            </div>
                  
        </div>
            
        

        <div class="right-container">
            <h1>Order details</h1>
            <div class="order-details">
                <div class="title"> Item(1) </div>
                <div class="value"><p><?php echo $productPrice ?></p></div>
            </div>
            <div class="order-details">
                <div class="title"> Shipping </div>
                <div class="value"> $5.00</div>
            </div>
            <div class="order-details">
                <div class="title"><strong>Total</strong> </div>
                <div class="value"><?php echo "$" . $productPrice * $q ?></div>
            </div>
            <input type="submit" name="place_order" value="Place Order">
            
        </div>
    </form>
    </div>

    </div>

    <?php include "./footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/addtocart.js"></script>

</body>

</html>
<?php
} else {
    header('Location: index.php');
    exit();
}

?>