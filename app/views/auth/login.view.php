<?php

use App\Core\App;
use App\Core\Request;
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
        @font-face {
            font-family: Nunito;
            src: url("<?= public_url('/assets/sprnva/fonts/Nunito-Regular.ttf') ?>");
        }

        body {
            font-weight: 300;
            font-family: Nunito;
            color: #26425f;
            background: #eef1f4;
        }

        .card {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            margin-bottom: 1rem;
            border-radius: .5rem !important;
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
                <div class="text-center mb-3">
                    <img src="<?= public_url('/storage/images/sprnva-logo.png') ?>" alt="sprnva-logo" style="width: 100px; height: 100px;">
                </div>
                <div class="card mt-4" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body">

                        <?= msg('RESPONSE_MSG'); ?>

                        <form method="POST" action="<?= route('/login') ?>">
                            <?= csrf() ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" autocomplete="off" autofocus value="<?= old('username') ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?= route('/forgot/password'); ?>" style="font-size: 18px;">
                                    <small id="emailHelp" class="form-text text-muted mb-1">Forgot password?</small>
                                </a>
                                <div class="d-flex justify-content-end ml-3"><button type="submit" class="btn btn-secondary btn-sm text-rigth">LOGIN</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <div class="card mt-2" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body d-flex justify-content-center align-items-center">

                        <small id="emailHelp" class="form-text text-muted mb-1">Return to</small>

                        <a href="<?= route('/'); ?>" class="ml-2" style="font-size: 14px;">Welcome page</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>