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

                        <form method="POST" action="<?= route('/forgot/password') ?>">
                            <?= csrf() ?>
                            <small class="text-muted">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</small>
                            <div class="form-group mt-3">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" autocomplete="off" autofocus>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?= route('/login'); ?>" style="font-size: 18px;">
                                    <small class="form-text text-muted mb-1">Back to login?</small>
                                </a>
                                <div class="d-flex justify-content-end ml-3"><button type="submit" class="btn btn-secondary btn-sm text-rigth">SEND PASSWORD RESET LINK</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>