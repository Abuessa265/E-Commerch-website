<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>
   <style>
      body {
         font-family: Arial, Helvetica, sans-serif;
         font-size: 20px;
      }

      #myBtn {
         display: none;
         position: fixed;
         bottom: 20px;
         right: 30px;
         z-index: 99;
         font-size: 10px;
         font-weight: 900;
         border: none;
         outline: none;
         background-color: #ff523b;
         color: white;
         cursor: pointer;
         padding: 12px;
         border-radius: 4px;
      }

      #myBtn:hover {
         background-color: #555;
      }
   </style>
</head>

<body>

   <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>

   <script>
      // Get the button
      let mybutton = document.getElementById("myBtn");

      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {
         scrollFunction()
      };

      function scrollFunction() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
         } else {
            mybutton.style.display = "none";
         }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
         document.body.scrollTop = 0;
         document.documentElement.scrollTop = 0;
      }
   </script>

</body>

</html>