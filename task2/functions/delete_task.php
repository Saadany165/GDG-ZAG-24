<?php
require_once "connect.php";
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $delete=$conn->query("DELETE FROM tasks WHERE id = $id");
    if($delete){
        header("Location: ../index.php");
    }
}else{header("Location: ../index.php");}
