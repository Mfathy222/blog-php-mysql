<?php if( ! empty($_SESSION['success'])):?>
<div class="alert alert-success">
<?php echo $_SESSION['success'] ?>
</div>
<?php endif;
unset($_SESSION['success']);
?>