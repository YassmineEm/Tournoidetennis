<?php
session_start();
if(!isset($_SESSION["joueur"])){
    header("Location:login.php");
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
    <div class="wrap">
      <h1>RALLY MASTERS</h1>
      <img class="img"src="res/LOGOO.png">
      <p>" Welcome to your personal tennis space! Explore your achievements, track match history, and stay updated on upcoming tournaments. Your journey in the world of tennis begins here! "</p>
      <div class="menu">
          <input type="checkbox" name="toggle" id="toggle"/>
          <label for="toggle"><span>Profile</span></label>
          <ul>
             <li><a>Account Settings</a></li>
             <li><a>Statistics</a></li>
             <li><a>Matches</a></li>
             <li><a>Ranking</a></li>
             <li><a href="retrieve_messages.php">Messages</a></li>
             <li><a href="logout.php">Sign Out</a></li>
           </ul> 
       </div>
    </div>
</body>
<style>
     @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&family=Poppins:wght@100&family=Sevillana&display=swap');
    body{
      background-color:#A7D5CD;
    }
    .img{
        position:absolute;
        top:25px;
        width:70px;
        height:70px;
    }
    h1{
        position:absolute;
        top:10%;
        left:36%;
        color:white;
        font-size:90px;
        font-family: 'Sevillana',sans-serif;
    }
    p{
      position:absolute;
      top:60%;
      left:7%;
      font-family: 'Sevillana',sans-serif;
      font-size:25px;
      color:white;
    }
    .menu {
       position:absolute;
       top:35%;
       left:34%;
       width: 300px;
       text-transform: uppercase;
       font-size: 14px;
    }
    input#toggle {
      position: absolute;
      z-index: -9999;
    }
    input#toggle:checked ~ label {
       background: #42423E;
    }
    input#toggle:checked ~ ul {
      display: block;
      opacity: 1;
      animation-play-state: running; 
    }
    ul {
      margin: 20px 0 0 0;
      display: none;
      opacity: 0;
      animation: fade .5s linear;
      animation-play-state: paused;  
   }
    label, li {
      width: 300px;
      background: #DF826B;
      display: block;
      padding: 15px 20px;
      cursor: pointer; 
    }
    label {
       box-shadow: 0 6px 10px -6px #4F4F4B;
    }
    li {
       border-bottom: 3px solid #42423E;
    }
    li:hover, label:hover {
       background: #42423E;
    }
    ul:before {
       display: block;
       content: '';
       width: 0; 
       height: 0; 
       border-left: 10px solid transparent;
       border-right: 10px solid transparent; 
       border-bottom: 15px solid #DF826B;
       position: relative;
       left: 100%;
    }
    li:last-child {
       border: none;
       box-shadow: 0 6px 10px -6px #4F4F4B;
    }
    a, span, h1 {
       color: #FFFFFF;
       text-fill-color: transparent;
       background: linear-gradient(transparent, transparent), linear-gradient(to bottom, #ffffff 0%,#efe9e8 100%) no-repeat;
       background: -o-linear-gradient(transparent, transparent);
       -webkit-background-clip: text; 
       cursor: pointer;  
    }
    h1{
      font-size: 20px;
      text-transform: uppercase;
      text-align: center;
      margin: 0 0 10px 40px;
    }
@keyframes fade {
  0% { opacity: 0; }
  100% { opacity: 1; }
}
</style>
</html>