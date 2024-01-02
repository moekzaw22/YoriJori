<?php
	include('Connection.php');
	$rows = array();
    date_default_timezone_set("Asia/Yangon");
$orderdate = date('Y/m/d');
	$fetch_rows = mysqli_query($connection,"SELECT total_price_p, Product_Name, Quantity, orr.Order_ID, Order_Date, Table_R FROM order_detail od, product p, order_r orr WHERE p.Product_ID=od.Product_ID AND orr.Order_ID = od.Order_ID AND orr.Order_Date = '$orderdate' ORDER BY Order_ID");


 $calculating_total = "SELECT SUM(total_price_p) AS totalprice, SUM(Quantity) AS sumqty FROM order_detail od, order_r orr WHERE orr.Order_Date = '$orderdate' AND od.Order_ID=orr.Order_ID";
$total_result = mysqli_query($connection, $calculating_total);

$row1 = mysqli_fetch_array($total_result);
$total_sum = $row1['totalprice'];
$sum = $row1['sumqty'];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="navbar.css">
 	<title></title>
 </head>
 <body>
   <div class="navbar-1">
         <a href="order_entry.php" class="link">Order</a>
        <a href="Sale_List.php" class="link active">Sale</a>
        <a href="Everydaysale.php" class="link">Daily</a>
    </div>
 	<form action="Sale_List_Search.php" method="GET">
 	<div class="search-container">
  <input type="date" name="datefrom" id="Datefrom" onchange="datefromchg()">
  <input type="date" name="dateto">
  <input type="submit" name="btnsearch" value="Search">
  <input type="submit" name="btnsearch" value="Top Sale">
</div>


<div class="order-info">
  <?php echo $orderdate ?> <span><?php echo number_format($total_sum) ?> Ks</span>
  <?php echo $sum ?> item(s) sold
</div>

<table>
  <tr>
    <th>Table No.</th>
    <th>Item</th>
    <th>Qty</th>
    <th>Total Sale</th>

  </tr>
  <?php
   while ($row = mysqli_fetch_assoc($fetch_rows)) {
      echo "<tr>";
      echo "<td>".$row['Table_R']."</td>";
      echo "<td>".$row['Product_Name']."</td>";
      echo "<td>".$row['Quantity']."</td>";
      echo "<td>".number_format($row['total_price_p'])."</td>";

      echo "</tr>";
    }
  ?>
</table>

 	</form>
    <script type="text/javascript">

    </script>
    <style type="text/css">

  table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
  }

  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  div.order-info {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
    margin-bottom: 10px;
  }

  div.order-info span {
    font-weight: bold;
    margin-left: 10px;
  }

  div.total-info {
    text-align: right;
    margin-top: 10px;
    font-weight: bold;
  }


    .search-container {
    display: flex;
    align-items: center;
    gap: 10px;

  }

  .search-container input[type="date"],
  .search-container input[type="submit"] {
    padding: 8px;
    font-size: 16px;
  }

  .search-container input[type="submit"] {
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
  }

  .search-container input[type="submit"]:hover {
    background-color: #555;
  }

</style>


 </body>
 </html>
