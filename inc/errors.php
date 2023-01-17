
<?php if(isset($_SESSION['errors'])):
    
    foreach($_SESSION['errors']as $errors):
    ?>
<div class="alert alert-danger">
<?php echo $errors ?>
</div>
<?php  endforeach ; endif ;unset($_SESSION['errors']);?>