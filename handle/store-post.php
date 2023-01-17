<?php

//connect-check-filter-vald-empty>insert-header

require_once "../inc/connection.php";

if(isset($_POST['submit'])){
    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));
   $errors = [];
    if(empty($title)){
       $errors[] = "title is required";

    }elseif(is_numeric($title)){
       $errors[] = "title must be string";
    }
    if(empty($body)){
       $errors[] = "body is required";

    }elseif(is_numeric($body)){
       $errors[] = "body must be string";
    }

    if ($_FILES && $_FILES['image']['name']) {

        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmpname = $image['tmp_name'];
        $size = $image['size'] / (1024 * 1024);
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $newname = uniqid() . time() . "." . $ext;

    }else{
        $newname = "";
    }

if(empty($errors)){

        $query = "INSERT INTO posts (`title`,`body`,`image`,`user_id`)
                              values('$title','$body','$newname',1)";
        $result = mysqli_query($conn, $query);
        if($result){
if($_FILES['image']['name']){

    move_uploaded_file($image_tmpname, "../uploads/$newname");

}


            $_SESSION['success']=["DONE"];

            header('location:../index.php');
        }else{

            $_SESSION['errors']=["error while insert post"];
            header('location:../create-post.php');


        }


}else{

    $_SESSION['errors']=$errors;
    $_SESSION['title']=$title;
    $_SESSION['body']=$body;
    header('location:../create-post.php');

}


}else{

    header('location:../create-post.php');
}