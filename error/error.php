<?php
// http_response_code(403);
header("refresh:5 url=../index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link rel="icon" href="../images/login/book1.png"> 
    <link rel="stylesheet" href="../css/error.css">
</head>

<body>
    <div class="container">
        <p id="top"></p>
        <div class="info">
            <p>403</p>
            <p>Forbidden</p>
            <p>Access to this resource is denied!</p>
        </div>
        <img src="../images/error/error2.png" id="i1">
    </div>
    
</body>

</html>

<?php
exit();
?>