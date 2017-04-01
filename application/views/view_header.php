<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php foreach($params as $row): ?>

    <title><?php echo $row['title']; ?> | ProjectUU</title>
    <link rel="stylesheet" type="text/css" href="assets/css/libraries/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href=<?php echo $row['headerCss']; ?>>
    <link rel="stylesheet" type="text/css" href=<?php echo $row['css']; ?>>

    <?php endforeach; ?>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="home"><img src="assets/img/logo.jpg" alt="Logo"></a>
        </div>
        <ul class="main-menu">
            <li><a href="home"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> <p>Dashboard</p></a></li>
            <li><a href="members"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <p>Members</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <p>Transactions</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <p>Calendar</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <p>Logs</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <p>Settings</p></a></li>
            <li><a href="logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> <p>Logout</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> <p>About</p></a></li>
        </ul>
    </nav>