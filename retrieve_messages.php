<?php
session_start();
if (!isset($_SESSION["joueur"])) {
    header("Location: login.php");
    die();
}
require_once "database.php";
$userConnected = $_SESSION["joueur"];
$sqlMessages = "SELECT * FROM messages WHERE recipient = '$userConnected' ORDER BY date DESC";
$resultMessages = $conn->query($sqlMessages);
if ($resultMessages->num_rows > 0) {
    while ($row = $resultMessages->fetch_assoc()) {
        echo "<div>";
        echo "<strong>De :</strong> " . $row["sender"] . "<br>";
        echo "<strong>Theme :</strong> " . $row["theme"] . "<br>";
        echo "<strong>Date :</strong> " . $row["date"] . "<br>";
        echo "<strong>Message :</strong> " . $row["message"] . "<br>";
        echo "</div><hr>";
    }
} else {
    echo "No message.";
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
    <h2>Messages Sent</h2>
</body>
</html>