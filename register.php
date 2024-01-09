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
    if(isset($_POST["submit"])){
        $fullName =$_POST["fullname"];
        $email =$_POST["email"];
        $password =$_POST["password"];
        $passwordRepeat =$_POST["repeat_password"];
        
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        $errors = array();

        if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
            array_push($errors,"All fields are required");
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,"Email is not valid");
        }
        if(strlen($password)<8){
            array_push($errors,"Password must be at least 8 charactes long");
        }
        if($password!==$passwordRepeat){
            array_push($errors,"Password does not match");
        }
        require_once "database.php";
        $sql ="SELECT * FROM joueurs WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount>0){
            array_push($errors,"Email already exists!");
        }
        if(count($errors)>0){
            foreach($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
            $role = 'user';
            if($email === 'admin@example.com'){
                $role = 'admin';
            }
            $sql ="INSERT INTO joueurs (full_name, email, password, role) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt,"ssss",$fullName, $email, $passwordHash,$role);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registed successfully.</div>";
            }else{
                die("something went wrong");
            }

        }
    }
    ?>
    <form action="register.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
        <p> Already have an account ? <a href="login.php">Login here</a></p>
    </form>
  </div>
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
</body>
</html>