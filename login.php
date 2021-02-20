<?php
session_start();

if(isset($_POST["login"])){

    include("conn.php");
    $results = mysqli_query($db, "SELECT username, password FROM users");
    $row = mysqli_fetch_array($results);
         
    if ($row["username"]== $_POST["username"] && $row["password"] == $_POST["password"]){
        $_SESSION["valid"]=$row["username"];
        header("Location: index.php");
    }
}

?>

   <!-- Login Page -->
   <h3>Login </h3>
        <form method="post">
        <input type="text" name="username" placeholder="username" />
        <input type="password" name="password" placeholder="password"/>
        <button type="submit" name="login">Submit</button>
        </form>