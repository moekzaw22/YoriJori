<?php
$conn = new mysqli('localhost', 'root', '', 'KoreanChicken');
$name=$_POST['name'];
$price=$_POST['price'];

echo $sql="INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Price`) VALUES (NULL, '$name', '$price')";

if ($conn->query($sql) === TRUE) {
    echo "data inserted";
}
else 
{
    echo "failed";
}