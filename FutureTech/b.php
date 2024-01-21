<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="date"></div>


    <?php
    $current_time = date('Y-m-d H:i:s');
    echo $current_time;
    ?>


    <script>
        setInterval(function() {
            var date = new Date();
            document.getElementById("date").innerHTML = date.toString();
        }, 1000);
    </script>


</body>

</html>