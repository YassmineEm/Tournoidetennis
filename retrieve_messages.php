<?php
session_start();
if (!isset($_SESSION["joueur"])) {
    header("Location: login.php");
    die();
}
require_once "database.php";
$email = $_SESSION["email"];
$sqlAdminMessages = "SELECT * FROM messages WHERE recipient = ? ORDER BY lu ASC, date DESC";

if ($stmt = $conn->prepare($sqlAdminMessages)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultAdminMessages = $stmt->get_result();
    $stmt->close();
} else {
    die("Erreur de préparation de la requête.");
}
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
    <?php
      if ($resultAdminMessages->num_rows > 0) {
        echo "<div class='messages-container'>";
        while ($row = $resultAdminMessages->fetch_assoc()) {
            echo "<div class='message'>";
            echo "<p><strong>Theme:</strong> " . $row["theme"] . "</p>";
            echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
            echo "<p><strong>Date:</strong> " . $row["date"] . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No messages found.</p>";
    }

    $conn->close();
    ?>
     <a href="Pagepropre.php" class="btn">Back to Profile</a>
</body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Bevan:ital@1&display=swap');
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
   }

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #00ee00;
    text-align: center;
    font-size:40px;
    font-family:'Bevan',sans-serif;
}

.messages-container {
    margin-top: 20px;
}

.message {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
}

.btn {
    display: block;
    margin-top: 20px;
    padding: 10px;
    background-color: #7eff5c;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
}

.btn:hover {
    background-color: #00cd00;
}
</style>
</html>