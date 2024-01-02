<?php
include('Connection.php');

// Fetch expense_id from the URL parameters if available
$expense_id = isset($_GET['expense_id']) ? $_GET['expense_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If expense_id is not set in the form, use the one fetched from URL parameters
    $expense_id = isset($_POST['expense_id']) ? $_POST['expense_id'] : $expense_id;

    // Debugging output
    echo "Debug: expense_id=$expense_id<br>";

  echo  $date = $_POST['txtdate'];
  echo  $category = $_POST['txtcategory'];
  echo   $description = $_POST['txtdescription'];
  echo  $quantity = $_POST['txtquantity'];
  echo  $amount = $_POST['txtamount'];

    // Update data in the expense table
    $sql = "UPDATE expense
            SET date='$date', category='$category', description='$description', quantity='$quantity', amount='$amount'
            WHERE expense_id='$expense_id'";

    // Execute the query and handle success/failure
    if (mysqli_query($connection, $sql)) {
        echo "Expense updated successfully.";
        header('Location: Expense_Entry.php');
      exit();
    } else {
        echo "Error updating expense: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>
