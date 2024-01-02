
       function validateForm() {
           // Check if the reset button was clicked
           var resetButton = document.querySelector('input[type="reset"]');
           if (resetButton && resetButton.clicked) {
               // Prevent form submission
               console.log('Form reset detected. Submission prevented.');
               return false;
           }

           // Your additional form validation logic goes here

           // If everything is valid, allow form submission
           return true;
       }

       // Add a click event listener to the reset button
       var form = document.getElementById('yourFormId');
       if (form) {
           form.addEventListener('reset', function () {
               // Set a flag when the reset button is clicked
               resetButton.clicked = true;
           });
       }
