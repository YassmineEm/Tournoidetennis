<?php
session_start();
if(!isset($_SESSION["joueur"])){
    header("Location:login.php");
}
if($_SESSION["role"] !== 'admin'){
    header("Location:access_denied.php");
    die();
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
    <h1>Admin Dashboard</h1>
    <p class="p">Welcome to the administration page of our website! This centralized interface provides secure access to essential management and control tools, allowing administrators to effectively oversee site activities. Through this user-friendly platform, you can manage users and publish content. We are committed to delivering powerful and intuitive features to streamline day-to-day site management, while ensuring data security and user-friendly navigation. Feel free to explore the different sections to make the most of your administrative capabilities. Thank you for your commitment to our community as an administrator.</p>
   <nav>
      <a href="membres.php"><img src=res/gens.png><i class="far fa-user"></i></a>
      <a href="messages.php"><img src=res/messager.png><i class="fas fa-briefcase"></i></a>
      <a href="logout.php"><img src=res/se-deconnecter.png><i class="far fa-file"></i></a>
    </nav>
  
    <div class= 'container'> 
       <section id= 'first'>
       </section>
       <section id= 'second'>
        </section>
       <section id= 'third'>
       </section>
    </div>
<style>
@import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Poppins:wght@100&family=Sevillana&display=swap');
h1{
    position:absolute;
    top:10px;
    left:35%;
    color:yellowgreen;
    font-family: 'Sevillana',sans-serif;
    font-size:50px;
}
.p{
    position:absolute;
    top:30%;
    left:10%;
    font-size:20px;
    font-family: 'Sevillana',sans-serif;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
--primary-color: #D96AA7;
--secondary-color: orange;
--complimentary-color: #88BFB5;
--contrast-color: #F2E527;
--light-color: #D2A9D9;
}

.container {
  background: white;
  min-height: 100vh;
  font-family: Montserrat, sans-serif;
}

nav a {
    font-size: 40px;
    color: #fff;
    text-decoration: none;
    padding: 20px;
    text-align: center;
}
nav a img{
     width:50px;
     height:50px;
}
nav {
    position: fixed;
    left: 0;
    z-index: 50;
    display: flex;
    justify-content: space-around;
    flex-direction: column;
    height: 100vh;
    background: var(--secondary-color);
}

section {
    position: absolute;
    top: 0;
    height: 100vh;
    width: 0;
    opacity: 0;
    transition: all ease-in .5s;
    display: flex;
    justify-content: center;
    align-items: center;
} 

section h1 {
    color: #fff;
    font-size: 50px;
    text-transform: uppercase;
    opacity: 0;
}

section:target {
    opacity: 1;
    position: absolute;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
}
@keyframes fadeIn {
    100% { opacity:1 }
}
</style>
</body>
</html>