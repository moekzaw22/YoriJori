<?php
include('Connection.php');

// Fetch data for the total amount and quantity spent each month, grouped by category
$sql = "SELECT
          DATE_FORMAT(Date, '%b') AS month,
          YEAR(Date) AS year,
          Category,
          SUM(Amount) AS totalAmount,
          CONCAT(SUM(CAST(SUBSTRING_INDEX(Quantity, ' ', 1) AS DECIMAL(10,2))), ' ', SUBSTRING_INDEX(Quantity, ' ', -1)) AS totalQuantity
        FROM Expense
        GROUP BY
          MONTH(Date),
          YEAR(Date),
          Category
        ORDER BY
          YEAR(Date),
          MONTH(Date),
          Category";

$result = mysqli_query($connection, $sql);

$sql1 = "SELECT
    MONTH(Date) AS month,
    YEAR(Date) AS year,
    SUM(Amount) AS totalAmount1
FROM Expense
GROUP BY
    YEAR(Date),
    MONTH(Date)
ORDER BY
    YEAR(Date),
    MONTH(Date)";

$result1 = mysqli_query($connection, $sql1);

// Close the database connection
mysqli_close($connection);

// Initialize variables to track the current month and year
$currentMonth = null;
$currentYear = null;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Total Expense Amount and Quantity by Month and Category</title>
    <!-- Add any other styles or scripts you may need -->
    <style media="screen">
      table{
        border-collapse: collapse;
        width:100%;
      }
      th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<script type="text/javascript">


    function showDetails(category) {
        // You can use AJAX to fetch details for the selected category
        if (category === "Groccery") {
          console.log('Fetching details for category: ' + category);
        }
        else{
          console.log('error');
        }

        // Alternatively, you can redirect the user to a new page with detailed information
        // window.location.href = 'details.php?category=' + category;
    }


</script>
<body>
<nav>
  <a href="Expense_Entry.php">Entry</a>
    <a href="Expense_List.php">List</a>
</nav>
<table border="1">
    <tr>
        <th>Category</th>
        <th>Total Amount</th>
        <th>Total Quantity</th>
    </tr>

    <?php
    $grandTotalAmount = 0.0;

    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the month or year has changed
        if ($row["month"] !== $currentMonth || $row["year"] !== $currentYear) {
            // Display the month and year row
            $grandTotalAmount = 0.0;
            echo "<tr style='background:yellow;'>
                    <td colspan='3'>{$row["month"]} {$row["year"]}</td>
                </tr>";

            // Display the grand total amount row from result1
            $row1 = mysqli_fetch_assoc($result1);
            $grandTotalAmount += $row1['totalAmount1'];
            echo "<tr style='background:lightgray;'>
                    <td><b>Grand Total</b></td>
                    <td><b>" . number_format($grandTotalAmount, 2) . "</b></td>
                    <td></td>
                </tr>";

            // Update current month and year
            $currentMonth = $row["month"];
            $currentYear = $row["year"];
        }

        // Display the item row
        echo "<tr id='{$row["Category"]}Row'>
                 <td>{$row["Category"]}</td>
                 <td>" . number_format($row["totalAmount"], 2) . "</td>
                 <td>{$row["totalQuantity"]}</td>
                   <td><button onclick='showDetails({$row["Category"]})'>View Details</button></td>
             </tr>";
    }
    ?>
</table>

<!-- Add any other content or navigation links you may need -->

</body>

</html>
