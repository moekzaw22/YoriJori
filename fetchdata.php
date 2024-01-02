
<?php
include('Connection.php');
if (isset($_GET['term'])) {
     
   $query = "SELECT * FROM Product WHERE Product_Name LIKE '{$_GET['term']}%' LIMIT 5";
    $result = mysqli_query($connection, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['Product_Name'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>