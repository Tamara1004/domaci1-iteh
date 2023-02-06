<?php

require "dbBroker.php";
require "model\User.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){ //ako je poslat zahtev za username i password
    $name = $_POST['username'];
    $passw = $_POST['password'];


    $usr = new User(1, $name, $passw);

    $respond = User::logInUser($usr,$conn); //pristup statickim funkcijama preko klase

    if($respond->num_rows==1) {
        echo   `
        <script>
        console.log("Uspešno ste se prijavili!");
        </script>
        `;

        $_SESSION['user_id'] = $usr->id;
        header("Location: home.php"); //ostajemo na home lokaciji. Da je pisalo . posle Location, onda bi to znacilo da ostajemo na trenutnoj lokaciji
        exit();
    } else { 
        echo `
        <script>
        console.log("Niste prijavljeni!");
        </script>
        `;
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Grande resto</title>

</head>
    <body>
        <div class="login-box">     
              <h2>Login</h2>
          <form method="POST" action="#">
            <div class="user-box">
                <input type="text" name="username" required>
                <label class="username">Username</label>
            </div>

            <div class="user-box">
                <input type="password" name="password" required>
                <label class="password">Password</label>
            </div>
            <button type="submit" name="submit"> 
            <span></span>
            <span></span>
            <span></span>
            <span></span> 
             Submit  
            </button>
            
          </form>
        </div>
    </body>
</html>
