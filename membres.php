<?php
session_start();
if (!isset($_SESSION["joueur"]) || $_SESSION["role"] !== 'admin') {
    header("Location: access_denied.php");
    die();
}
require_once "database.php";
$sqlSelect = "SELECT * FROM joueurs WHERE role != 'admin'";
$resultSelect = mysqli_query($conn, $sqlSelect);
if (mysqli_num_rows($resultSelect) > 0) {
    $membres = mysqli_fetch_all($resultSelect, MYSQLI_ASSOC);
} else {
    $membres = array(); 
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
    <h1>list of members</h1>
    <form action="admin_dashboard.php">
         <button class="btn">Return</button>
    </form>
    <?php if (!empty($membres)) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($membres as $membre) : ?>
              <tr>
                <td><?= $membre['id'] ?></td>
                <td><?= $membre['full_name'] ?></td>
                <td><?= $membre['email'] ?></td>
                <td class="actions">
                    <form action="supprimer.php" method="post">
                        <input type="hidden" name="id" value="<?= $membre['id'] ?>">
                        <button type="submit" class="delete-btn">DELETE</button>
                    </form>
                    <a href="modifier.php?id=<?= $membre['id'] ?>" class="edit-btn">MODIFY</a>
              </tr>
            <?php endforeach; ?>
        </table>
        <?php else : ?>
           <p>No members found.</p>
        <?php endif; ?>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Poppins:wght@100&family=Sevillana&display=swap');
    h1{
       position:absolute;
       top:-8px;
       left:35%;
       color:orange;
       font-family: 'Sevillana',sans-serif;
       font-size:50px;
    }
    table{
        position:absolute;
        top:17%;
        left:50px;
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        border-spacing: 0;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
    }

    th {
            background-color: #4CAF50;
            color: white;
    }

    tr:nth-child(even) {
            background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
            background-color: #ffffcc;
    }

    p {
            text-align: center;
            color: #333;
    }
    .actions {
            display: flex;
            gap: 8px;
    }

    .delete-btn {
            background-color: #ff5050;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
    }

    .edit-btn {
            background-color: #3399ff;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
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