<?php
include('Connection.php');
 $select = "SELECT
  Order_Date, SUM(total_price_p) AS totalp,
  SUM(Quantity) AS Sum FROM order_r orr, order_detail od WHERE orr.Order_ID=od.Order_ID GROUP BY Order_Date";
$select_query=mysqli_query($connection,$select);


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
     <nav class="navbar-1">
         <a href="order_entry.php" class="link">Order</a>
        <a href="Sale_List.php" class="link">Sale</a>
        <a href="" class="link active">Daily</a>
    </nav>
 	<table>
 		<tr>
 			<td>Date</td>
 			<td>Sale Count</td>
 			<td>Sale Amount</td>
 		</tr>

 	<?php
 		  while ($row = mysqli_fetch_array($select_query)) {
 		  	  $sum = $row['Sum'];
 		  	  $date = $row['Order_Date'];
 		  	  $total_price = $row['totalp'];
 		  	  echo "<tr>";
 		  	  echo "<td>".$date."</td>";
 		  	  echo "<td>".$sum."</td>";
 		  	  echo "<td>".number_format($total_price)." Ks</td>";
 		  	  echo "</tr>";
 		  }

 	 ?>
 	 </table>
 </body>
 <style type="text/css">
   table{
      width:100%;
         border-collapse: collapse;
   }
 	table tr td{

 		border:1px dotted grey;
    font-size: 20px;
 	}

 </style>
 </html>
