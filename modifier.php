<?php
session_start();
if (!isset($_SESSION["joueur"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["joueur"]) || $_SESSION["role"] !== 'admin') {
    header("Location: access_denied.php");
    die();
}
require_once "database.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM joueurs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $fullname = $row['full_name'];
            $email = $row['email'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newFullname = $_POST["new_fullname"];
                $newEmail = $_POST["new_email"];
                $updateSql = "UPDATE joueurs SET full_name = ?, email = ? WHERE id = ?";
                $updateStmt = mysqli_prepare($conn, $updateSql);
                if ($updateStmt) {
                   mysqli_stmt_bind_param($updateStmt, 'ssi', $newFullname, $newEmail, $id);
                   mysqli_stmt_execute($updateStmt);
                   header("Location: membres.php");
                   exit();
                }
            }
        } else {
            echo "No users found with this ID.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Query preparation error: " . mysqli_error($conn);
    }
} else {
    echo "User ID not specified.";
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
</head>
<body>
    <h2>Edit user</h2>
    <form action="modifier.php?id=<?php echo $id; ?>" method="post">
        <label for="new_fullname"class="btn1">Nouveau nom complet:</label>
        <input class="btn11"type="text" id="new_fullname" name="new_fullname" value="<?php echo $fullname; ?>" required>

        <label class="btn2"for="new_email">Nouvel email:</label>
        <input class="btn22"type="email" id="new_email" name="new_email" value="<?php echo $email; ?>" required>

        <input class="btn"type="submit" value="To update">
    </form>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Poppins:wght@100&family=Sevillana&display=swap');
    h2{
        position:absolute;
        top:15%;
        left:39%;
        color:orange;
        font-family: 'Sevillana',sans-serif;
        font-size:40px;
    }
    .btn1{
        position:absolute;
        top:40%;
        left:30%;
    }
    .btn11{
        position:absolute;
        top:40%;
        left:45%;
    }
    .btn2{
        position:absolute;
        top:50%;
        left:30%;
    }
    .btn22{
        position:absolute;
        top:50%;
        left:45%;
    }
    .btn{
        position:absolute;
        top:60%;
        left:43%;
        border:none;
        background-color:orange;
        color:white;
        font-size:15px;
        padding:8px;
    }
    .btn:hover{
        background-color:#F05E16;
    }
</style>
</html>

