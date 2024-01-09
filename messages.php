<?php
session_start();
if (!isset($_SESSION["joueur"]) || $_SESSION["role"] !== 'admin') {
    header("Location: access_denied.php");
    die();
}
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = isset($_POST["recipient"]) ? $_POST["recipient"] : "";
    $theme = isset($_POST["theme"]) ? $_POST["theme"] : "";
    $messageContent = isset($_POST["message"]) ? $_POST["message"] : "";

    if (!empty($recipient) && !empty($theme) && !empty($messageContent)) {
        $sqlRecipient = "SELECT * FROM joueurs WHERE email = '$recipient'";
        $resultRecipient = $conn->query($sqlRecipient);

        if ($resultRecipient->num_rows > 0) {
            $dateEnvoi = date("Y-m-d H:i:s");
            $lu = false;

            $stmt = $conn->prepare("INSERT INTO messages (recipient, theme, message, date, lu) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $recipient, $theme, $messageContent, $dateEnvoi, $lu);

            if ($stmt->execute()) {
                echo "Message sent successfully.";
            } else {
                echo "an error happened while sending the message : " . $stmt->error;
            }
        } else {
            echo "The recipient does not exist in the database.";
        }
    } else {
        echo "Please complete all fields on the form.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="res/LOGOO.png">
    <title>Tennis Tournoi</title>
</head>
<body>
    <h2>Messaging</h2>
    <form action="admin_dashboard.php">
         <button class="btn">Return</button>
    </form>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label class="destinataire">Recipient :</label>
        <input class="d" type="text" name="recipient" required><br>

        <label class="sujet">theme :</label>
        <input class="s" type="text" name="theme" required><br>

        <label class="message">Message :</label>
        <textarea class="t" name="message" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Send" class="send">
    </form>
</body>
<style>
     @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Poppins:wght@100&family=Sevillana&display=swap');
    h2{
        position:absolute;
        top:10%;
        left:43%;
        font-family: 'Sevillana',sans-serif;
        font-size:50px;
        color:#7cfc00;
    }
    .destinataire{
        position:absolute;
        top:25%;
        left:10%;
    }
    .sujet{
        position:absolute;
        top:32%;
        left:10%;
    }
    .message{
        position:absolute;
        top:40%;
        left:10%;
    }
    .send{
        position:absolute;
        left:20%;
        top:60%;
        border:none;
        padding:5px;
        color:white;
        background-color:#7cfc00;
    }
    .send:hover{
        background-color:#3e7e00;
    }
    .d{
        position:absolute;
        left:20%;
        top:25%;
    }
    .s{
        position:absolute;
        left:20%;
        top:31%;
    }
    .t{
        position:absolute;
        top:36%;
        left:20%;
    }
    .btn{
        position:absolute;
        top:30px;
        left:15px;
        border:none;
        background-color:#7cfc00;
        color:white;
        padding:10px;
        font-size:15px;
    }
    .btn:hover{
        background-color:#3e7e00;
    }
</style>
</html>