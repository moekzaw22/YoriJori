<?php 
	include('Connection.php');
	$product = "SELECT * FROM product";
	$product_query = mysqli_query($connection,$product);
	
	
if ($product_query) {
    while ($product_row = mysqli_fetch_assoc($product_query)) {
        $product_id = $product_row['Product_ID'];
        $product_name = $product_row['Product_Name'];
        $product_price = $product_row['Product_Price'];

        // Display or use the product information as needed
        echo "Product ID: $product_id<br>";
        echo "Product Name: $product_name<br>";
        echo "Product Price: $product_price<br>";
        echo "<hr>"; // Separator between products
    }

    // Free the result set
    mysqli_free_result($product_query);
} else {
    echo "Error executing product query: " . mysqli_error($connection);
}

 ?>
