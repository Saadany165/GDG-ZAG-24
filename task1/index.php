<?php

require_once "functions/connect.php";

session_start();
if(isset($_SESSION['data'])) {
    if(time()-$_SESSION['data']['session_time'] > $_SESSION['data']['time']){
        session_destroy();
        header("location:Auth/login_form.php");
        exit();
    }
    $id=$_SESSION['data']['id'];
//    $user = $conn->query("SELECT * FROM users WHERE id='$id' ")->fetch_assoc();
}else{header("location:Auth/login_form.php");}
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <a href="functions/logout.php">logout</a>
    <h1 >Hi, <?= $_SESSION['data']['name']; ?></h1>
    <br><br>
</body>
</html>
