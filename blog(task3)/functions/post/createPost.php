<?php
session_start();
require_once "../connect.php";
if(!isset($_SESSION['user'])){
    echo "cannot create post";
    require "../../index.php";
    die();
}elseif (isset($_SESSION['user'])){
    $data=[
      "content"=>$_POST['content'],
      "user_id"=>$_SESSION['user']['id']
    ];
    $post=$conn->query("INSERT INTO `posts` (`content`,`user_id`) VALUES ('{$data["content"]}','{$data["user_id"]}')");
    if($post){
        header("location:../../index.php");
    }
}
