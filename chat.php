<?php
include_once 'config.php';



if ($_POST['form'] == 'new' && $_POST['content'] != '') {
    $content = $_POST['content'];
    $user = $_POST['user'];
    $sql = "INSERT INTO message (user, content)
    VALUES ('$user', '$content')";

    if ($conn->query($sql) === TRUE) {
        //true
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
