<?php
session_start();


$conn = mysqli_connect("localhost", "root","" , "blog-php-mysql") or die('Could not connect!');
if($conn){
    echo 'database connected';
}
// $conn=mysqli_connect("localhost","root","","blog-php-mysql");



