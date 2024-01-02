<?php
$quantity = 0;
$table_R = 0;
include('Connection.php');
$total_sum = 0;
date_default_timezone_set("Asia/Yangon");
$orderdate = date('Y/m/d');
// Perform proper database connection error handling
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// Counting order
$last_order = "SELECT Order_ID FROM order_r ORDER BY Order_ID DESC";
$lastorder_query = mysqli_query($connection, $last_order);
$count_order = mysqli_num_rows($lastorder_query);
// Getting last page
$lastorder = ceil($count_order / 1);
// Selecting order for new order button
$order_tdy = "SELECT Order_ID FROM order_r WHERE Order_Date = '$orderdate'";
$order_tdy_q = mysqli_query($connection, $order_tdy);
$order_tdy_count = mysqli_num_rows($order_tdy_q);
$table_R = $order_tdy_count + 1;

if (isset($_REQUEST['OID'])) {
    $OID = $_GET['OID'];
}

if (empty($OID)) {
    $OID = $lastorder;
} else if ($OID > $lastorder) {
    $neworder = "INSERT INTO order_r VALUES ('', '$table_R', '$orderdate')";
    $new_order_query = mysqli_query($connection, $neworder);
}
if ($OID < 1) {
    $OID = 1;
}
if (isset($_POST['lastorder'])) {
    $OID = $lastorder;
}
$get_order = "SELECT * FROM order_r WHERE Order_ID = '$OID'";
$order_Query = mysqli_query($connection, $get_order);
$order_array = mysqli_fetch_array($order_Query);
$order_ID = $order_array['Order_ID'];
$table = $order_array['Table_R'];

$select_total = "SELECT SUM(total_price_p) AS totalprice FROM order_detail WHERE Order_ID = '$order_ID'";
$total_result = mysqli_query($connection, $select_total);
$row1 = mysqli_fetch_array($total_result);
$total_sum = $row1['totalprice'];

// Close the database connection


// Continue with the rest of your code
 ?>
 <link rel="stylesheet" type="text/css" href="navbar.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<!-- jQuery UI -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <title>Order Entry</title>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap Css -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <div class="navbar-1">
   
         <a href="" class="link active">Order</a>
        <a href="Sale_List.php" class="link">Sale</a>
        <a href="Everydaysale.php" class="link">Daily</a>
    </div>
