<?php

use App\Core\App;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
    <title>
        <?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name']; ?>
    </title>

    <link rel="stylesheet" href="<?= public_url('/assets/sprnva/css/bootstrap.min.css') ?>">

    <style>
        body {
            background-color: #eef1f4;
        }
    </style>

    <script src="<?= public_url('/assets/sprnva/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= public_url('/assets/sprnva/js/popper.min.js') ?>"></script>
    <script src="<?= public_url('/assets/sprnva/js/bootstrap.min.js') ?>"></script>
</head>

<body>
    <div class="container" style="margin-top: 3%;">
        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <div class="card mt-4" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body">

                        <?= msg('RESPONSE_MSG'); ?>

                        <form method="POST" action="<?= route('/reset/password') ?>">
                            <?= csrf() ?>
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <small class="text-muted">You can now update your password.</small>
                            <div class="form-group mt-3">
                                <label for="reset-email">New password</label>
                                <input type="password" class="form-control" name="new_password" autocomplete="off" autofocus>
                            </div>
                            <div class="form-group mt-3">
                                <label for="reset-email">Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password" autocomplete="off" autofocus>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex justify-content-end ml-3"><button type="submit" class="btn btn-secondary btn-sm text-rigth">SAVE PASSWORD</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>