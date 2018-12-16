<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <h1>Crear Nuevo Hilo</h1>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <label for="threadname">Nombre del hilo</label>
                <input type="text" class="form-control <?=($errors['threadname'])?"is-invalid":""?>" id="threadname" name="threadname" aria-describedby="threadnameHelp" placeholder="Introduce un nombre para el hilo" value="<?=($thread['name']??'')?>">
                <small id="usernameHelp" class="form-text text-muted">Debe tener como mínimo 8 caracteres con números y letras minúsculas.</small>
                <?php if( !empty($errors['threadname']) ): ?> 
                <div class="invalid-feedback">
                    <?php foreach ($errors['threadname'] as $error): ?>
                        <?=$error?><br/>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="threaddesc">Descripción</label>
                <textarea class="form-control" id="threaddesc" name="threaddesc" rows="3"><?=($thread['description']??'')?></textarea>
            </div>
            <button type="submit" name="edit_thread" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>