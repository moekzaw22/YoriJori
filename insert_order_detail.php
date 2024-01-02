<?php 
include('Connection.php');
$order_id= $_POST['order_id'];
$Product_ID = $_POST['productid'];
$fetch_product =  mysqli_query($connection,"SELECT * FROM product WHERE Product_ID ='$Product_ID' OR Product_Name = '$Product_ID'");
$product_fetch = mysqli_fetch_array($fetch_product);
$price = $product_fetch['Product_Price']; 
$Product_ID = $product_fetch['Product_ID'];
$product_name = $product_fetch['Product_Name'];
$checking_quantity = "SELECT * FROM order_detail WHERE Product_ID = '$Product_ID' AND Order_ID = '$order_id'";
$quantity_f_query = mysqli_query($connection,$checking_quantity);
$count = mysqli_num_rows($quantity_f_query);
  if ($count == 0 ) {
      $insert_order_detail = "INSERT INTO order_detail VALUES ('','$order_id','$Product_ID','$price','1','$price')";
  if ($connection->query($insert_order_detail) === TRUE) {
   
}
else 
{
    echo "failed";
}
       }
       elseif ($count > 0) {    
            $add_quantity = "UPDATE order_detail SET Quantity= Quantity + 1, total_price_p =total_price_p +$price WHERE Product_ID = '$Product_ID' AND Order_ID = '$order_id'";
if ($connection->query($add_quantity) === TRUE) {
    
}
else 
{
    echo "failed";
}
           
       }

 ?>