<?php
require_once "connect.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST["id"];
    $data=[
        "name"=>$_POST["name"],
        "description"=>$_POST["description"],
        "date"=>$_POST["date"],
        "user_id"=>$_POST["user_id"]
    ];
    $update=$conn->query("UPDATE tasks SET name='$data[name]',description='$data[description]',date='$data[date]',user_id='$data[user_id]' WHERE id=$id ");
    if($update){
        header("Location: ../index.php");
    }

}else{header("Location: ../index.php");}
