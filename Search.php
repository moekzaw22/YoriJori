<?php  
   include('Connection.php'); 
    
    if(isset($_POST["query"])){  
        $output = '';  
        $query = "SELECT * FROM product WHERE Product_Name LIKE '%".$_POST["query"]."%'";  
        $result = mysqli_query($connection, $query);  
        $output = '<ul class="list-unstyled">';  
        
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  
                $output .= '<li>'.$row["Product_Name"].'</li>';  
            }  
        }else{  
            $output .= '<li>Product Not Found</li>';  
        }  
    
    $output .= '</ul>';  
    echo $output;  
    } 
?>
<style type="text/css">
    ul, li{
        cursor:pointer;
       background-color: #f9f9f9;
       padding:10px 0px;
    }
    .list-unstyled{
  background-color: #f9f9f9;
  min-width: 160px;
 
  z-index: 1;
    }
    li:hover{
        background:#f1f1f1;
       
    }
</style>