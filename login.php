<?php
// Start the session
session_start();
    
if (isset($_POST['user'])) {
    
    // Set session variables
    $_SESSION["user"] = $_POST['user'];

    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <select name="user" id="">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <input type="submit" value="Login">
    </form>
</body>

</html>


