<?php 
include('Connection.php');
if (isset($_REQUEST['btnsearch'])) {
	$value = $_GET['btnsearch'];
	$Fromdate = $_GET['datefrom'];
	$Todate = $_GET['dateto'];
	$row = array();
// $Fromdate = '2022/12/26';
// $Todate = '2023/1/2';

	if ($value == "Top Sale") {
		if (!empty($Fromdate) && empty($Todate)) {
		}
		## showing only 1 day record
		else if (empty($Todate) && !empty($Fromdate)) {
			$topsale_q = "SELECT 
    od.Product_ID ,sum(od.Quantity) AS sumqty 
FROM 
    order_detail od
    LEFT JOIN product p ON od.Product_ID = p.Product_ID
    LEFT JOIN order_r orr ON orr.Order_ID = od.Order_ID 
WHERE
    orr.Order_Date BETWEEN '$Fromdate' AND '$Todate' 
GROUP BY 
    p.Product_ID 
ORDER BY 
    sumqty DESC";	
			$query = mysqli_query($connection,$topsale_q);
		}
		#showing record 
		else if (empty($Todate) && empty($Fromdate)) {
			echo "Present null";
		 $topsale_q = "SELECT sum(Quantity) AS sumqty, order_detail.Product_ID,Product_Name, totalprice FROM order_detail, product, order_r WHERE order_detail.Product_ID = product.Product_ID AND order_r.Order_ID = order_detail.Order_ID GROUP BY product.Product_ID ORDER BY sum(Quantity) DESC";	
		$query = mysqli_query($connection,$topsale_q);
		$count = $row1['sumqty'];
		}
		else if (!empty($Todate) && !empty($Fromdate)) {
			echo "Present all";
			 $topsale_q = "SELECT 
    od.Product_ID ,Product_Name, sum(od.Quantity) AS sumqty 
											FROM 
											    order_detail od
											    LEFT JOIN product p ON od.Product_ID = p.Product_ID
											    LEFT JOIN order_r orr ON orr.Order_ID = od.Order_ID 
											WHERE
											    orr.Order_Date BETWEEN '$Fromdate' AND '$Todate' 
											GROUP BY 
											    p.Product_ID 
											ORDER BY 
											    sumqty DESC";	
   
		$query = mysqli_query($connection,$topsale_q);
		$fetch_rows ="SELECT total_price_p, Product_Name, Quantity, orr.Order_ID, Table_R, orr.Order_Date FROM order_detail od, 					 product p, order_r orr WHERE p.Product_ID=od.Product_ID AND orr.Order_ID = od.Order_ID AND 
								  Order_Date BETWEEN '$Fromdate' AND '$Todate' ORDER BY Order_ID";
 $rs_rw =mysqli_query($connection,$fetch_rows);	
 $select_total = "SELECT SUM(total_price_p) AS totalprice FROM order_detail od, order_r orr WHERE orr.Order_Date 
 BETWEEN '$Fromdate' AND '$Todate' AND orr.Order_ID=od.Order_ID";
            $total_result = mysqli_query($connection,$select_total);
            $row1=mysqli_fetch_array($total_result);
           echo $total_sum = $row1['totalprice'];
		}
		
		
			

		
	}
	## End of top sale button
	## start of the Search button
		elseif ($value == "Search") {
			## if todate is empty and fromdate is true
				if (!empty($Fromdate) && empty($Todate)) {
				  	$topsale_q = "SELECT 
    od.Product_ID , Product_Name, sum(od.Quantity) AS sumqty 
FROM 
    order_detail od
    LEFT JOIN product p ON od.Product_ID = p.Product_ID
    LEFT JOIN order_r orr ON orr.Order_ID = od.Order_ID 
WHERE
    orr.Order_Date = '$Fromdate'  
GROUP BY 
    p.Product_ID 
ORDER BY 
    sumqty DESC";	
			$query = mysqli_query($connection,$topsale_q);
			
			 $fetch_rows ="SELECT total_price_p, Product_Name, Quantity, orr.Order_ID, Table_R, orr.Order_Date FROM order_detail od, product p, order_r orr WHERE p.Product_ID=od.Product_ID AND orr.Order_ID = od.Order_ID AND Order_Date = '$Fromdate' ORDER BY Order_ID";
 $rs_rw =mysqli_query($connection,$fetch_rows);			
 $select_total = "SELECT SUM(total_price_p) AS totalprice FROM order_detail od, order_r orr WHERE orr.Order_Date = '$Fromdate' AND orr.Order_ID=od.Order_ID";
            $total_result = mysqli_query($connection,$select_total);
            $row1=mysqli_fetch_array($total_result);
            $total_sum = $row1['totalprice'];

				}
				## two date not null
			elseif (!empty($Fromdate) && !empty($Todate)) {
				$topsale_q = "SELECT 
    od.Product_ID , Product_Name, sum(od.Quantity) AS sumqty 
FROM 
    order_detail od
    LEFT JOIN product p ON od.Product_ID = p.Product_ID
    LEFT JOIN order_r orr ON orr.Order_ID = od.Order_ID 
WHERE
    orr.Order_Date >= '$Fromdate' AND orr.Order_Date <= '$Todate'
GROUP BY 
    p.Product_ID 
ORDER BY 
    sumqty DESC";	
			$query = mysqli_query($connection,$topsale_q);
$count = mysqli_num_rows($query);
 $sumqty = $row['sumqty'];
			 $fetch_rows ="SELECT total_price_p, Product_Name, Quantity, orr.Order_ID, Table_R, orr.Order_Date FROM order_detail od, product p, order_r orr WHERE p.Product_ID=od.Product_ID AND orr.Order_ID = od.Order_ID AND Order_Date >= '$Fromdate' AND Order_Date <= '$Todate' ORDER BY Order_ID";
 $rs_rw =mysqli_query($connection,$fetch_rows);	
 

 $select_total = "SELECT SUM(total_price_p) AS totalprice FROM order_detail od, order_r orr WHERE orr.Order_Date 
 BETWEEN '$Fromdate' AND '$Todate' AND orr.Order_ID=od.Order_ID";
            $total_result = mysqli_query($connection,$select_total);
            $row1=mysqli_fetch_array($total_result);
           echo $total_sum = $row1['totalprice'];
			}
		}
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title></title>
 </head>
 <body>
 	<div class="grid-container">
 		Total Sale <?php echo number_format($total_sum); 

 		if (empty($Todate)) {
 			echo "<br>";
 			echo "Date = ", $Fromdate;
 		}
 		else{
 			echo "<br>";
 			echo "Showing sale records between ", $Fromdate ," And ", $Todate;
 		}
 		echo "Total Item Sale",$sum;
 		?>
 			<form action="Sale_List_Search.php" method="GET">
 	<input type="date" name="datefrom" id="Datefrom" value="<?php echo $Fromdate ?>" 	onchange="datefromchg()">
 	<input type="date" name="dateto">
 		<input type="submit" name="btnsearch" value="Search" >
 	<input type="submit" name="btnsearch" value="Top Sale">
 		
 		<div class="left">
 				<table>
 		<tr>
 			<td>ID</td>
 			<td>Name</td>
 			<td>Total Sale</td>
 		</tr>

 	<?php 

 		       while ($row = mysqli_fetch_array($query)) { 
 		       $sum = $row['sumqty'];
 		     	$product_name = $row['Product_Name'];
 		       $id = $row['Product_ID'];

 		       // $search_product = mysqli_query($connection,"SELECT * FROM product WHERE Product_ID = '$id'");
 		       // $fetch = mysqli_fetch_array($search_product);
                echo "<tr>";
                  echo "<td>".$id."</td>";
                        echo "<td>".$product_name."</td>";
                    echo "<td>".$sum ."</td>";

             
                   
                echo "</tr>";
              
            
            }
 	 ?>
 	 </table>
 		</div>

 		<div class="right">
 				<table>
 		<tr>
 			<td>Order N0.</td>
 			<td>Table No.</td>
 			<td>Item</td>
 			<td>Qty</td>
 			<td>Total Sale</td>
 			
 		</tr>
 		<?php 
 		
	
 			while ($row = mysqli_fetch_assoc($rs_rw)) {
  			$orderid = $row['Order_ID'];
  			$tabler = $row['Table_R'];
  			$productname = $row['Product_Name'];
  			$quantity = $row['Quantity'];
  			$totalpricep =  $row['total_price_p'];
  			$orderdate =  $row['Order_Date'];
  			echo "<tr>";
  			echo "<td>".$orderid."</td>";
  			echo "<td>".$tabler."</td>";
  			echo "<td>".$productname."</td>";
  			echo "<td>".$quantity."</td>";
  			echo "<td>".$totalpricep."</td>";
  		
  			echo "</tr>";
			}
 		 ?>
 	</table>
 		</div>
 	</div>
 
 </body>
 <style type="text/css">
 	.grid-container {
 
}

.left {
 position: absolute;
 left: 0px;
 width: 29%;
  border: 1px solid grey;
}

.right {
 position: absolute;
 width: 70%;
  border: 1px solid grey;
 right: 0px;
}
 </style>
 </html>