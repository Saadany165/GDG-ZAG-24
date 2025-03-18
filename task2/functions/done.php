<?php
require_once "connect.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $done = $conn->query("UPDATE tasks SET done=1 WHERE id=$id");
    if ($done) {
        header("location:../index.php");
    } else {
        echo "Error in done";
    }
}else{"location:../index.php";}
