<?php

use App\Core\App;
use App\Core\Auth;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
    <title>
        <?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name'] ?>
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

        .bg-light {
            background-color: #ffffff !important;
        }

        .card {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            margin-bottom: 1rem;
            border-radius: .5rem !important;
        }

        .wlcm-link {
            text-decoration: underline !important;
            color: inherit;
        }

        .link-green {
            color: #00551f !important;
        }
    </style>

    <script src="<?= public_url('/assets/sprnva/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= public_url('/assets/sprnva/js/popper.min.js') ?>"></script>
    <script src="<?= public_url('/assets/sprnva/js/bootstrap.min.js') ?>"></script>

    <?php
    // this will auto include filepond css/js when adding filepond in public/assets
    if (file_exists('public/assets/filepond')) {
        require_once 'public/assets/filepond/filepond.php';
    }
    ?>

    <script>
        const base_url = "<?= App::get('base_url') ?>";
    </script>
</head>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 d-flex flex-row justify-content-end">
                <?php if (fortified()) { ?>
                    <ul class="navbar-nav flex-row ml-md-auto">
                        <li class="nav-item">
                            <a class="nav-link link-green" href="<?= route('/login') ?>">Login</a>
                        </li>
                        <li class="nav-item pl-2 pr-2">
                            <span class="nav-link text-muted">|</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-green" href="<?= route('/register') ?>">Register</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-12">
                <div class="d-flex flex-row align-items-center">
                    <img src="<?= public_url('/storage/images/sprnva-logo.png') ?>" alt="sprnva-logo" style="width: 65px; height: 65px;">
                    <h1 class="pl-2 mb-0" style="color: #00551f;font-weight: 600;">Sprnva</h1>
                </div>
                <div class="card mt-3">
                    <!-- <h5 class="card-header">Welcome to your Sprnva application!</h5> -->
                    <div class="card-body">
                        <p class="card-text">Sprnva will provide you experience and expand your vision for a better understanding of the basics. We'll help you take your first steps as a web developer or give you a boost as you take your expertise to the next level. Featuring Model-view-controller software design pattern, debugging, secure and organized routing, expressive database builder and more.</p>
                    </div>

                    <div class="col-12">
                        <div class="row p-2">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="wlcm-link" href="https://docs.sprnva.space" target="_blank">Documentation</a></h5>
                                        <p class="card-text pt-1 text-muted">Sprnva has also a dedicated documentation covering every aspect of the framework. Newbies or have previous experience with Sprnva, we recommend reading all documenataion.</p>
                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="wlcm-link" href="https://github.com/sprnva" target="_blank">Github</a></h5>
                                        <p class="card-text pt-1 text-muted">Visit Sprnva repository and explore other projects like migration, file uploads, dumper also known as dd() and also the flavoured templates of sprnva.</p>
                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="wlcm-link" href="https://github.com/jagwarthegreat/jagwarthegreat/blob/main/README.md" target="_blank">The Author</a></h5>
                                        <p class="card-text pt-1 text-muted">Meet the creator and the mastermind behind the blast! the author of this fun is happy to see you. You might also want to follow him and send a feedback.</p>
                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a class="wlcm-link" href="#">Why Sprnva?</a></h5>
                                        <p class="card-text pt-1 text-muted">Simple codebase yet powerful, embraces your basic knowledge of creating a web application. Small scale file structure but packed with securities and protection from unwanted attacks.</p>
                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>