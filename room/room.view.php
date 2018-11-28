<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <?php if( $room ): ?>
        <h2><?=$room['name']?></h2>
        <p><?=$room['description']?></p>
        <p><?=$room['cathegory']?></p>
        <?php endif; ?>
        <?php if( mysqli_num_rows($result_items) == 0): ?>
        <div class="alert alert-warning" role="alert">
            No hay comentarios.
        </div>
        <?php endif; ?>
        <?php if( $result_items ): ?>
        <ul class="room-group">
        <?php while($item = mysqli_fetch_assoc($result_items) ): ?>
            <li class="room-group-item room-group-item-info">
            <?=$item['description']?>
            <a href="<?=BASE_URL?>delete_item/?room_id=<?=$room['id']?>&item_id=<?=$item['id']?>"><i class="far fa-trash-alt float-right"></i></a>
            <a href="<?=BASE_URL?>edit_item/?room_id=<?=$room['id']?>&item_id=<?=$item['id']?>"><i class="far fa-edit float-right"></i> </a></li>
        <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <input type="text" class="form-control <?=($errors['item'])?"is-invalid":""?>" id="item" name="item" aria-describedby="itemHelp" placeholder="Introduce un nuevo item" value="<?=($item??'')?>">
                <small id="itemHelp" class="form-text text-muted">Debe introducir algo</small>
                <?=validationDiv('item', 'invalid-feedback')?>
            </div>
            <?=validationDiv('login','alert')?>
            <button type="submit" name="saveitem" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>