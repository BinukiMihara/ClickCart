<?php
require './conn.php';
$a = 1;

if ($a = 1 ) {
    // Seller ID to delete
    $sellerId = 7;

    // Check for referencing records
    $sqlProducts = "SELECT COUNT(*) FROM product WHERE seller_ID = '$sellerId'";
    $sqlRatings = "SELECT COUNT(*) FROM rating WHERE seller_ID = '$sellerId'";
    $sqlOrderItems = "SELECT COUNT(*) FROM order_items WHERE seller_ID = '$sellerId'";

    $resultProducts = $con->query($sqlProducts);
    $resultRatings = $con->query($sqlRatings);
    $resultOrderItems = $con->query($sqlOrderItems);

    $numProducts = $resultProducts->fetch_row()[0];
    $numRatings = $resultRatings->fetch_row()[0];
    $numOrderItems = $resultOrderItems->fetch_row()[0];

    if ($numProducts > 0 || $numRatings > 0 || $numOrderItems > 0) {
        echo "Cannot delete the seller. There are referencing records in other tables.";
    } else {
        // Delete referencing records
        $sqlDeleteProducts = "DELETE FROM product WHERE seller_ID = '$sellerId'";
        $sqlDeleteRatings = "DELETE FROM rating WHERE seller_ID = '$sellerId'";
        $sqlDeleteOrderItems = "DELETE FROM order_items WHERE seller_ID = '$sellerId'";

        $con->query($sqlDeleteProducts);
        $con->query($sqlDeleteRatings);
        $con->query($sqlDeleteOrderItems);

        // Delete the seller record
        $sqlDeleteSeller = "DELETE FROM seller WHERE seller_ID = '$sellerId' LIMIT 1";
        $con->query($sqlDeleteSeller);

        echo "Seller record deleted successfully.";
    }
    $con->close();
}
?>
