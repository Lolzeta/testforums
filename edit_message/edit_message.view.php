<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <?php if( $message ): ?>
        <h2><a href="<?=BASE_URL.'thread/?id='.$thread_id?>"><?=$message['thread_name']?></a></h2>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <input type="text" class="form-control <?=($errors['message'])?"is-invalid":""?>" id="message" name="message" aria-describedby="messageHelp" placeholder="Introduce un nuevo message" value="<?=($message['message_text']??'')?>">
                <small id="messageHelp" class="form-text text-muted">Debe introducir algo</small>
                <?=validationDiv('message', 'invalid-feedback')?>
            </div>
            <?=validationDiv('login','alert')?>
            <button type="submit" name="edit_message" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>