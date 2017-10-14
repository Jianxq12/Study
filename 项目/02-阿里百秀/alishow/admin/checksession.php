<?php
session_start();
if(empty($_SESSION['id'])){
    header('location:../err.php?errno=901');
    die;
}