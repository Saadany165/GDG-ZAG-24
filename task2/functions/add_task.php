<?php
require_once "connect.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $data=[
        "name"=>$_POST["name"],
        "description"=>$_POST["description"],
        "date"=>$_POST["date"],
        "user_id"=>$_POST["user_id"]
    ];
    $insert=$conn->query("INSERT INTO tasks(name,description,date,user_id) VALUES('$data[name]','$data[description]','$data[date]','$data[user_id]')");
    if($insert){
        header("location:../index.php");
    }else{ echo "Error";}
}else{header("location:../index.php");}
