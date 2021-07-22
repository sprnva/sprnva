<?php require __DIR__ . '/head.php';

use App\Core\Auth;
?>
<div class="row pb-3">
    <div class="col-12">
        <?= alert_msg(); ?>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <div>
                    <h5>Profile Information</h5>
                    <small class="text-muted">Update your account's profile information.</small>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">
                                <form method="POST" action="<?= route('/profile', Auth::user('id')) ?>">
                                    <?= csrf() ?>
                                    <div class="form-group">
                                        <label for="username">E-mail</label>
                                        <input type="email" class="form-control" name="email" autocomplete="off" value="<?= $user_data['email'] ?>">
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
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-5">
                    <h5>Change Profile password</h5>
                    <small class="text-muted">Update your account's password.</small>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">

                                <form method="POST" action="<?= route('/profile/changepass') ?>">
                                    <?= csrf() ?>
                                    <div class="form-group">
                                        <label for="username">Old Password</label>
                                        <input type="password" class="form-control" name="old-password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">New Password</label>
                                        <input type="password" class="form-control" name="new-password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm-password" autocomplete="off"">
                                </div>
                                <div class=" d-flex justify-content-end"><button type="submit" class="btn btn-success btn-sm text-rigth">UPDATE PASSWORD</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-5">
                    <h5>Delete Account</h5>
                    <small class="text-muted">Remove your account information in this application.</small>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12 mt-5 mb-4">
                        <div class="card" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                            <div class="card-body">

                                <div class="alert alert-warning" style="border-left-width: 4px;">
                                    This will delete all of your account's data. Your data will not be recoverable.
                                </div>

                                <form method="POST" action="<?= route('/profile/delete', Auth::user('id')) ?>">
                                    <?= csrf() ?>
                                    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-danger btn-sm text-rigth">DELETE ACCOUNT</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>