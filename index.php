<?php 

// Start the session
session_start();

if(!isset($_SESSION["user"])){
  header('location: login.php');
}

include_once 'config.php';

$user = $_SESSION["user"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Daily UI #013: Direct Messaging</title>
  <link rel="stylesheet" href="css/normalize.min.css">
  <link rel='stylesheet' href='css/css.css'>
  <link rel='stylesheet' href='css/jquery.mCustomScrollbar.min.css'>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="chat">
    <div class="chat-title">
      <h1>Shuvo</h1>
      <h2>Online</h2>
      <figure class="avatar">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure>
    </div>
    <div class="messages">
      <div class="messages-content">
        <?php 
        $sql = "SELECT * FROM message LIMIT 15";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

              if($row["user"] == $user){
                echo '<div class="message message-personal" data-id="' . $row["id"]. '">' . $row["content"]. '<div
                class="timestamp">' . date("H:i", strtotime($row["timestamp"])) . '</div></div>';
              }else{
                echo '
                <div class="message new" data-id="' . $row["id"]. '">
                    <figure class="avatar"><img
                        src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg" /></figure>' . $row["content"]. '<div
                      class="timestamp">' . date("H:i", strtotime($row["timestamp"])) . '</div>
                  </div>
                ';
              }
            }
        }
        ?>
      </div>
    </div>
    <div class="message-box">
      <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
      <input type="hidden" value="<?=$user?>" class="user">
      <button type="submit" class="message-submit">Send</button>
    </div>

  </div>
  <div class="bg"></div>
  <script src='js/jquery.min.js'></script>
  <script src='js/jquery.mCustomScrollbar.concat.min.js'></script>
  <script src="js/script.js"></script>

</body>

</html>