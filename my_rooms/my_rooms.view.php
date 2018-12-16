<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div id="my_rooms" class="row">
    <?php while($room = mysqli_fetch_assoc($result_rooms)): ?>
        <div class="col-sm">
            <div id="card_room" class="card" style="width: 18rem;">
                <div class="card-body">
                    <h4 class="card-title"><?=$room['name']?></h4>
                    <h5 class="card-title"><?=$room['category']?></h5>
                    <p class="card-text"><?=$room['description']?></p>
                    <p class="text-right"><a href="<?=BASE_URL?>edit_room/?id=<?=$room['id']?>"><i class="fas fa-edit"></i></a></p>
                    <a href="<?=BASE_URL?>delete_room/?id=<?=$room['id']?>" class="card-link float-right btn btn-danger text-left">Borrar sala</a>
                    <a href="<?=BASE_URL?>room/?id=<?=$room['id']?>" class="card-link btn btn-primary">Ver sala</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</div>
<?php require_once '../includes/footer.php'; ?>