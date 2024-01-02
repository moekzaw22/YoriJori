<?php
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <link rel="stylesheet" href="navbar.css">
     <script type="text/javascript">
     function showSection(sectionId) {
    var sections = ["customer", "item", "supplier", "report", "special", "admin"];

    sections.forEach(function (section) {
      document.getElementById(section).style.display = section === sectionId ? "block" : "none";
    });
  }
     </script>
   </head>
   <body>
      <nav>
        <a href="Expense_Entry.php">Entry</a>
        <a href="Expense_List.php">List</a>
      </nav>
   </body>
 </html>
