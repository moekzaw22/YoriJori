<?php
include('Connection.php');
date_default_timezone_set('Asia/Yangon');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form
    $date = $_POST['txtdate'];
    $category = $_POST['txtcategory'];
    $description = $_POST['txtdescription'];
    $quantity = $_POST['txtquantity'];
    $amount = $_POST['txtamount'];

    // Insert data into the expense table
    $sql = "INSERT INTO expense (date, category, description, quantity, amount) VALUES ('$date', '$category', '$description', '$quantity', '$amount')";

    if (mysqli_query($connection, $sql)) {
        echo "Expense added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

$sql = "SELECT * FROM expense Where date = '".date('Y-m-d')."'";
$result = mysqli_query($connection, $sql);

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<script type="text/javascript" src="Prevent_reset.js">

</script>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body {
         font-family: Arial, sans-serif;
         overflow-x: auto;
     }

     form, table {
         margin: 20px;
         border-collapse: collapse;
     }
     form {
               max-width: 600px; /* Set your desired max-width */
               margin: auto; /* Center the form on the page */
           }

           .sticky-div {
               position: sticky;
               top: 0;
               background-color: white; /* Optional: Set the background color */
               z-index: 1;
           }

           table {
               border-collapse: collapse;
               width: 100%;
           }

           th, td {
               border: 1px solid #dddddd;
               text-align: left;
               padding: 8px;
           }

           th {
               background-color: #f2f2f2;
           }
     table {
         width: 100%;
         border: 1px solid #ddd;
     }

     th, td {
         padding: 10px;
         text-align: left;
         border-bottom: 1px solid #ddd;
     }

     th {
         background-color: #f2f2f2;
     }

     input[type="date"],
     input[type="text"],
     select,
     input[type="submit"],
     input[type="button"] {
         padding: 2px;
         margin: 1px 0;
     }
 </style>
</head>
<nav>
  <a href="Expense_Entry.php">Entry</a>
    <a href="Expense_List.php">List</a>
</nav>
<body>
  <script>
  function submitForm(expenseId) {
      console.log('Form ID:', expenseId);
      var form = document.getElementById('updateForm' + expenseId);
      if (form) {
          var hiddenInput = form.querySelector('input[name="expense_id"]');
          if (!hiddenInput) {
              hiddenInput = document.createElement('input');
              hiddenInput.type = 'hidden';
              hiddenInput.name = 'expense_id';
              form.appendChild(hiddenInput);
          }
          hiddenInput.value = expenseId;
          form.submit();
      } else {
          console.error('Form not found with ID:', 'updateForm' + expenseId);
      }
  }
</script>


    <form action="Expense_Entry.php" method="post">
      <div class="sticky-div">
          <table>
              <tr>
                  <th>Date</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Amount</th>
              </tr>

              <tr>
                  <td><input type="date" value="<?php echo date('Y-m-d') ?>" name="txtdate" required></td>
                  <td><select id="categorySelect" name="txtcategory" onchange="toggleVisibility()">

                     <option value="Meal_Egg">Meal & Egg</option>
                     <option value="Groccery">Groccery</option>
                     <option value="Fruit_Veg">Fruit & Veg</option>
                     <option value="Parcel_Products">Parcel Products</option>
                 </select></td>

                  <td><input type="text" name="txtdescription" required></td>
                  <td><input type="text" name="txtquantity" required></td>
                  <td><input type="text" name="txtamount" required></td>
                  <td><input type="submit" name="" value="Add Expense"> </td>
              </tr>
          </table>
      </div>
    </form>


        <table>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
          echo "<form id='updateForm{$row["Expense_ID"]}' action='Update_Expense.php' method='post'>";
          echo "<tr>
                  <td><input type='date' name='txtdate' value='{$row["Date"]}' onblur='submitForm({$row["Expense_ID"]})'></td>
                  <td><input type='text' name='txtcategory' value='{$row["Category"]}' onblur='submitForm({$row["Expense_ID"]})'></td>
                  <td><input type='text' name='txtdescription' value='{$row["Description"]}' onblur='submitForm({$row["Expense_ID"]})'></td>
                  <td><input type='text' name='txtquantity' value='{$row["Quantity"]}' onblur='submitForm({$row["Expense_ID"]})'></td>
                  <td><input type='text' name='txtamount' value='{$row["Amount"]}' onblur='submitForm({$row["Expense_ID"]})'></td>
              </tr>";
          echo "</form>";
      }


            ?>
        </table>

</body>

</html>
