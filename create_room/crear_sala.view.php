<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <h1>Crear Nueva Sala</h1>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <label for="roomname">Nombre de la sala</label>
                <input type="text" class="form-control <?=($errors['roomname'])?"is-invalid":""?>" id="roomname" name="roomname" aria-describedby="roomnameHelp" placeholder="Introduce un nombre para la room" value="<?=($roomname??'')?>">
                <small id="usernameHelp" class="form-text text-muted">Debe tener como mínimo 4 caracteres con números y letras minúsculas.</small>
                <?php if( !empty($errors['roomname']) ): ?> 
                <div class="invalid-feedback">
                    <?php foreach ($errors['roomname'] as $error): ?>
                        <?=$error?><br/>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="roomdesc">Descripción</label>
                <textarea class="form-control" id="roomdesc" name="roomdesc" rows="3"><?=($roomdesc??'')?></textarea>
            </div>
            <button type="submit" name="new_room" class="btn btn-primary">Nueva Sala</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>