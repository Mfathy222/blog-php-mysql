<?php
require_once '../inc/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT id, image FROM  posts WHERE id=$id";
    
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        unlink("../uploads/$image");
        $query = "DELETE from posts WHERE id =$id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = "post deleted successfuly";
            header('location:../index.php');
        } else {
            $_SESSION['error'] = "error while deleting";
            header('location:../index.php');
        }
    } else {
        $_SESSION['error'] = "no data found";
        header('location:../index.php');
    }

} else {
    header('location:../index.php');

}
?>