<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <!-- boton de vuelta -->
        <a href="<?=BASE_URL?>room/?id=<?=$_GET['room_id']?>"><i class="fas fa-long-arrow-alt-left"></i>Volver atrás</a>
        <?php if( $thread ): ?>
        <h2><?=$thread['name']?></h2>
        <p><?=$thread['description']?></p>
        <p class="text-right"><a href="<?=BASE_URL?>edit_thread/?room_id=<?=$_GET['room_id']?>&thread_id=<?=$_GET['id']?>"><i class="fas fa-edit"></i></a></p>
        <?php endif; ?>
        <?php if( mysqli_num_rows($result_messages) == 0): ?>
        <div class="alert alert-warning" role="alert">
            No hay mensajes.
        </div>
        <?php endif; ?>
        <?php if( $result_messages ): ?>
        <ul class="thread-group">
        <?php while($message = mysqli_fetch_assoc($result_messages) ): ?>
            <li class="thread-group-message thread-group-message-info">
            <?=$_SESSION['usuario']['username']?>: <?=$message['description']?>
            <a href="<?=BASE_URL?>delete_message/?room_id=<?=$_GET['room_id']?>&thread_id=<?=$thread['id']?>&message_id=<?=$message['id']?>"><i class="far fa-trash-alt float-right"></i></a>
            <a href="<?=BASE_URL?>edit_message/?room_id=<?=$_GET['room_id']?>&thread_id=<?=$thread['id']?>&message_id=<?=$message['id']?>"><i class="far fa-edit float-right"></i> </a></li>
        <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <input type="text" class="form-control <?=($errors['message'])?"is-invalid":""?>" id="message" name="message" aria-describedby="messageHelp" placeholder="Introduce un nuevo message" value="<?=($message??'')?>">
                <small id="messageHelp" class="form-text text-muted">Debe introducir algo</small>
                <?=validationDiv('message', 'invalid-feedback')?>
            </div>
            <?=validationDiv('login','alert')?>
            <button type="submit" name="savemessage" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>