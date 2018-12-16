<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <?php if( $room ): ?>
        <h1><?=$room['name']?></h1>
        <h4><?=$room['category']?></h4>
        <p><?=$room['description']?></p>
        <p class="text-right"><a href="<?=BASE_URL?>edit_room/?id=<?=$room['id']?>"><i class="fas fa-edit"></i></a></p>
        <?php endif; ?>
        <?php if( mysqli_num_rows($result_threads) == 0): ?>
        <div class="alert alert-warning" role="alert">
            No hay hilos.
        </div>
        <?php endif; ?>
        <?php if( $result_threads ): ?>
        <ul class="room-group">
        <?php while($thread = mysqli_fetch_assoc($result_threads) ): ?>
            <li class="room-group-thread room-group-thread-info">
            <a href="<?=BASE_URL?>thread/?room_id=<?=$room['id']?>&id=<?=$thread['id']?>"><?=$thread['name']?></a>
            <a href="<?=BASE_URL?>delete_thread/?room_id=<?=$room['id']?>&thread_id=<?=$thread['id']?>"><i class="far fa-trash-alt float-right"></i></a>
            <a href="<?=BASE_URL?>edit_thread/?room_id=<?=$room['id']?>&thread_id=<?=$thread['id']?>"><i class="far fa-edit float-right"></i> </a></li>
        <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
        <button type="submit" name="savethread" class="btn btn-primary">Crear hilo</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>