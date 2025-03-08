<?php
session_start();
if(isset($_SESSION['data'])){
    session_destroy();
    header("Location: ../Auth/login_form.php");
}