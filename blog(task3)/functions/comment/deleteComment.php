<?php
session_start();
require_once "../connect.php";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $comment_id=$_GET['id'];
    if(!isset($_SESSION['user'])){
        echo "cannot delete comment";
        require "../../index.php";
        die();
    }elseif(isset($_SESSION['user'])){

        $delete=$conn->query("DELETE FROM `comments` WHERE `id`='{$comment_id}'");
        if($delete) {
            header("location: ../../index.php");
        }else{
            echo "data not found";
            require "../../index.php";
            die();
        }

    }
}else{
    echo "data not found";
    require "../../index.php";
    die();
}

?>