<?php

use App\Core\App;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= App::get('config')['app']['name'] . " | " . ucfirst($pageTitle); ?>
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            background-color: #eef1f4;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 3%;">
        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <div class="text-center mb-3">
                    <h4>Register</h4>
                </div>
                <div class="card mt-4" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body">
                        <small class="form-text mb-1" style="color: blue;">
                            <?= $_SESSION["ALERT_MSG"] ?>
                        </small>
                        <small id="emailHelp" class="form-text mb-1" style="color: red;">
                            <?= $_SESSION["VALIDATION_ERROR"]['register'] ?>
                        </small>

                        <form method="POST" action="<?= route('register') ?>">
                            <div class="form-group">
                                <label for="r_email">E-mail</label>
                                <input type="text" class="form-control" name="r_email" autocomplete="off" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="r_name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="r_username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="r_password" autocomplete="off">
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="<?= route('login'); ?>" style="font-size: 18px;">
                                    <small id="emailHelp" class="form-text text-muted mb-1">Already registered?</small>
                                </a>
                                <button type="submit" class="btn btn-secondary btn-sm text-rigth ml-2">REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>