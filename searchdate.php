<?php 
 include('Connection.php'); 


    if(isset($_POST["DateFrom"])){  
        $output = '';  
        $query = "SELECT * FROM Order_R WHERE Order_Date = '"$_POST["DateFrom"]"'";  
        $result = mysqli_query($connection, $query);  
        $output = '<ul class="list-unstyled">';  
        
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  
                $output .= '<li>'.$row["DateFrom"].'</li>';  
            }  
        }else{  
            $output .= '<li>User Not Found</li>';  
        }  
    
    $output .= '</ul>';  
    echo $output;  
    } 
?>
<style type="text/css">
    ul, li{
        cursor:pointer;
        background:;
        border:1px solid grey;
    }
</style>
 ?>