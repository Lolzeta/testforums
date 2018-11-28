<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <div class="alert alert-warning" role="alert">
            No hay hilos.
        </div>
        <hr>
        <form action="../create_thread/?room_id=<?=$room_id?>" method="POST" novalidate>
            <button type="submit" name="createthread" class="btn btn-primary">Crear hilo</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>