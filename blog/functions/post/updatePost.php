<?php
session_start();
require_once "../connect.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $content=$_POST['content'];
    $post_id=$_POST['id'];
    if(!isset($_SESSION['user'])){
        echo "cannot edit post";
        require "../../index.php";
        die();
    }elseif(isset($_SESSION['user'])){

            $post=$conn->query("UPDATE `posts` SET `content`='{$content}' WHERE `id`='{$post_id}'");
            if($post) {
                header("location: ../../index.php");
            }else{
                echo "data not found";
                require "../../forms/editPost.php";
                die();
            }

    }
}else{
    echo "data not found";
    require "../../forms/editPost.php";
    die();
}

?>