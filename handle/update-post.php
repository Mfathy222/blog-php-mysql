<?php

// connection-supmit-filter-vald
require('../inc/connection.php');


if (isset($_POST['submit'])) {

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $title = trim(htmlspecialchars($_POST['title']));
        $body = trim(htmlspecialchars($_POST['body']));
        $errors = [];
        if (empty($title)) {
            $errors[] = "title is required";

        } elseif (is_numeric($title)) {
            $errors[] = "title must be string";
        }


        if (empty($body)) {
            $errors[] = "body is required";

        } elseif (is_numeric($body)) {
            $errors[] = "body must be string";
        }
        $query = "SELECT image FROM posts WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $post = mysqli_fetch_assoc($result);
            $oldimage = $post['image'];
        }



        if ($_FILES && $_FILES['image']['name']) {

            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmpname = $image['tmp_name'];
            $size = $image['size'] / (1024 * 1024);
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $newname = uniqid() . time() . "." . $ext;

        } else {
            $newname = $oldimage;
        }

        if (empty($errors)) {
            $query = "UPDATE posts SET `title`='$title',`body`='$body', `image`='$newname' WHERE id=$id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                if ($_FILES['image']['name']) {
                    move_uploaded_file($image_tmpname, "../uploads/$newname");
                    unlink("../uploads/$oldimage");

                }
                $_SESSION['success'] = "post updated succesfuly";
                header("location:../show-post.php?id=$id");


            } else {
                $_SESSION['errors'] = ['erorr while update'];
                header("location:../edit-post.php?id=$id");

            }
        } else {
            $_SESSION['errors'] = $errors;
            header("location:../edit-post.php?id=$id");
        }


    } else {
        header('location:index.php');

    }
} else {
    header('../location:index.php');

}