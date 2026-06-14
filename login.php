<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Govorukhin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

    <body>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="mb-4">Login</h1>
                    <form action="/login.php" method="POST" class="d-flex flex-column gap-3">
                        <input type="text" name="login" class="form-control hacker-input" placeholder="login">
                        <input type="password" name="password" class="form-control hacker-input" placeholder="password">
                        <button class="btn btn-primary" type="submit" name="submit">Login</button>
                        <p class="mt-3">Don't have an account? <a href="/registration.php">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
<footer>DevSecOps is a metholodogy, not just a profession</footer>

</html>

<?php
require_once('db.php');

if (isset($_COOKIE['User'])){
    header("location: /profile.php");
    exit();
}

$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'app');

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if (!$login || !$pass) die ("input all parameters");

    $sql = "SELECT * FROM users WHERE username='$login' AND pass='$pass'";

    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        setcookie("User", $login, time()+7200);
        header("location: profile.php");
    } else {
        echo 'incorrect username or password';
    }
}
?>