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
    <link rel="stylesheet" type="text/css" href=<?php echo $row['css']; ?>>

    <?php endforeach; ?>
</head>
<body>
    <ul>
        <li><a href="home">Home</a></li>
        <li><a href="members">Members</a></li>
        <li><a href="logout">Logout</a></li>
    </ul>