<?php
include_once 'config.php';


//save message
if ($_POST['form'] == 'new' && $_POST['content'] != '') {
    $content = $_POST['content'];
    $user = $_POST['user'];
    $touser = $_POST['touser'];
    $sql = "INSERT INTO message (user, touser, content)
    VALUES ('$user', '$touser' ,'$content')";

    if ($conn->query($sql) === TRUE) {
        //true
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//get message
if ($_POST['form'] == 'old' && $_POST['last_id'] != '') {
    $last_id = $_POST['last_id'];
    $user = $_POST['user'];
    $touser = $_POST['touser'];
    $sql = "SELECT * FROM message WHERE id>$last_id AND user = $touser AND touser = $user";

    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            $response = array();
            if ($row["touser"] == $user) {
                $response['html'] =  '
                <div class="message new" data-id="' . $row["id"] . '">
                    <figure class="avatar"><img
                        src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure>' . $row["content"] . '<div
                      class="timestamp">' . date("H:i", strtotime($row["timestamp"])) . '</div>
                  </div>
                ';
                $response['id'] = $row["id"];
            }
          }
          echo json_encode($response);
        }
}


$conn->close();
