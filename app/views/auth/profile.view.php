<?php require __DIR__ . '/../layouts/head.php';

use App\Core\App; ?>

<div class="row pb-3">
    <div class="col-md-4">
        <h5>Profile Information</h5>
        <small class="text-muted">Update your account's profile information.</small>
    </div>

    <div class="col-md-8">
        <div class="card" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
            <div class="card-body">

                <small id="emailHelp" class="form-text mb-1" style="color: red;">
                    <?= $_SESSION["VALIDATION_ERROR"]['profile'] ?>
                </small>

                <form method="POST" action="<?= route('profile') ?>">
                    <div class="form-group">
                        <label for="username">E-mail</label>
                        <input type="email" class="form-control" name="email" autocomplete="off" value="<?= $user_data['email'] ?>" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="<?= $user_data['fullname'] ?>">
                    </div>
                    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-secondary btn-sm text-rigth">SAVE</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>