<?php
session_start();
if (!isset($_SESSION["joueur"])) {
    header("Location: login.php");
    exit();
}
session_start();
if (!isset($_SESSION["joueur"]) || $_SESSION["role"] !== 'admin') {
    header("Location: access_denied.php");
    die();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
require_once 'database.php';
$sql = "DELETE FROM joueurs WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Player removed successfully.";
        } else {
        echo "Error deleting player: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Query preparation error:" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: membres.php");
    die();
} else {
    header("Location: membres.php");
    die();
}
?>