<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/loading_style.css">
</head>

<body>
    <div id="loader"></div>




    <script type="text/javascript">
        var loader;

        function loadNow(opacity) {
            if (opacity <= 0) {
                displayContent();
            } else {
                loader.style.opacity = opacity;
                window.setTimeout(function() {
                    loadNow(opacity - 0.05)
                }, 100);
            }
        }

        function displayContent() {
            loader.style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }
        document.addEventListener("DOMContentLoaded", function() {
            loader = document.getElementById('loader');
            loadNow(1);
        });
    </script>
</body>

</html>