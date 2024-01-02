<?php  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	 <!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 
<!-- Bootstrap Css -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<input type="text" name="name" id="productname">
	<input type="text" name="price" id="productprice">
	<button id="Save">Save</button>
</body>
 <script type="text/javascript">
        $(document).ready(function(){
            $("#Save").click(function(){
            	 var name=$("#productname").val();
                var price=$("#productprice").val();

        $.ajax({
                    url:'insert_product.php',
                    method:'POST',
                    data:{
                        name:name,
                        price:price
                    },
                   success:function(data){
                    alert('Success');
                       document.getElementById("productname").value= "";
                       document.getElementById("productprice").value="";
                       document.getElementById("productname").focus();
                   }
                });
         });
            });
    var input = document.getElementById("productprice");
         input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("Save").click();
  }
});
    </script>
</html>