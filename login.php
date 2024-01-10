<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content=" width=device-width,initial-scale=1.0">
  <link rel="icon" href="res/LOGOO.png">
  <title>Tennis Tournoi</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <header>
    <a href="http://localhost/tournoidetennis/index.php#logo">
        <img class="LOGOO"src="res/LOGOO.png" alt="logo">
    </a>
    <nav>
      <a href="http://localhost/tournoidetennis/index.php#Home">
         <button class="box">Home</button>
      </a>
      <a href="http://localhost/tournoidetennis/index.php#About">
          <button class="box">About</button>
      </a>
      <a href="http://localhost/tournoidetennis/index.php#Inscription">
          <button class="box">Register</button>
      </a>
      <a href="http://localhost/tournoidetennis/index.php#Connection">
          <button class="box">Log in</button>
      </a>
    </nav>
   </header>
   <div class="container">
    <?php
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FROM joueurs WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $joueur = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($joueur){
            if(password_verify($password,$joueur["password"])){
                session_start();
                $_SESSION["joueur"] = "yes";
                $_SESSION["role"] = $joueur["role"];
                $_SESSION["email"] = $email;
                if($joueur["role"] === 'admin'){
                    header("Location: admin_dashboard.php");
                    die();
                }else{
                   header("Location: Pagepropre.php");
                   die();
                }
            }else{
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
        }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
        }
      }
    ?>
     <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter Email:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter Password:">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login" name="login">
        </div>
        <p> Don't have an account? <a href="register.php">sign up here</a></p>
      </form>
  </div>
</body>
<style>
    body{
        padding:50px;
    }
    header{
    position:fixed;
    top:0px;
    left:0px;
    text-align:center;
    background-color:rgb(151, 242, 33);
    color: #5ff528;
    padding: 15px;
    width:100%;
    z-index:1000;
   }
    header img{
       position:absolute;
       left:27px;
       top:5px;
       width:60px;
       height:60px;
    }
    .logo{
       width:100%;
       height:100vh;
       background-size:cover;
       display:flex;
       align-items: center;
       justify-content: center;
    }
    .container{
        position:absolute;
        top:100px;
        left:25%;
        max-width: 600px;
        margin:auto;
        padding:50px;
        box-shadow: rgba(100,100,111,0.2) 0px 7px 29px 0px;
    }
    .form-group{
        margin-bottom:30px;
    }
    .box{
      background-color:#f5e8df;
      color:black;
      cursor:pointer;
      border-radius: 15px;
      padding:10px;
      font-size:14px;
      border:none;
      margin-right: 10px;
   }
   .box:hover{
      background-color:#35e096;
    }
    nav {
       display: flex;
       justify-content: flex-end; 
    }
    .box:last-child {
       margin-right: 60px; 
    }
    p {
      text-align : center;
      margin : 5px 0;
      font-size: 14px;
    }
    p a {
      text-decoration: 0;
      color: #17a2b8;
    }
    p a:hover{
        text-decoration : underline;
    }
</style>
</html>