<!DOCTYPE html>
<html>
<head>
    <title>Login Success!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['id'])) {
            header('Location: login.php');
        }
        else {
            $u_id = $_SESSION['id'];
            $u_name = $_SESSION['name'];
        } 
    ?>
    <form action="member_update.php" method="POST">
        <input type="hidden" value="<?php echo $u_id ?>" name="u_id">
        <button class="signUp_button" type="summit"><?php echo $u_id; ?></button>
    </form>
    <p>Login Success!</p>
    <input type="button" value="Logout" onclick="location.href='logout.php'">
</body>