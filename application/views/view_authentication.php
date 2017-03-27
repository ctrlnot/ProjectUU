<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Login | ProjectUU </title>
</head>
<body>
    <h1>o p p s !</h1>
    <form id="loginForm" action="login/validate" method="post">
        <input type="text" name="username" id="username" class="username" placeholder="Username">
        <input type="password" name="password" id="password" class="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>

    <!-- Scripts -->
    <script src="assets/js/libraries/jquery.min.js"></script>
    <script src="assets/js/auth.js"></script>
</body>
</html>