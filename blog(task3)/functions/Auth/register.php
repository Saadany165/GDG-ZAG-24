<?php
require_once "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email Address";
        require_once "location:../../Auth/register.html";
    }else{
        $data=[
            "name"=>$_POST["name"],
            "email"=>$_POST["email"],
            "password"=>$_POST["password"],
            "permission"=>$_POST["permission"]
        ];
        $register= $conn->query("INSERT INTO users (`name`,`email`,`password`,`permission`) VALUES ('{$data['name']}','{$data["email"]}','{$data["password"]}','{$data["permission"]}')");
        if($register){
            header("location:../../Auth/login.html");
        }else{
            header("location:../../Auth/register.html");
        }

    }

}else{header("location:../../index.php");}


