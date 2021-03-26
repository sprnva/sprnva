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
                    <svg height="70pt" preserveAspectRatio="xMidYMid meet" viewBox="0 0 318 305" width="70pt" xmlns="http://www.w3.org/2000/svg">
                        <g transform="matrix(.1 0 0 -.1 0 305)" style="fill:#0a9e6e">
                            <path d="m1480 2939c-560-43-1059-436-1234-972-92-281-92-601 0-884 27-83 112-265 139-298l17-20-8 20c-4 11-9 63-11 115-3 76-9 105-30 147-35 74-31 163 12 225 45 63 104 90 187 86 82-4 139-39 176-108 20-38 23-56 20-112-5-86-40-141-115-178-50-24-50-25-45-65 9-74 54-136 113-158 14-4 17 5 23 55 13 124 104 341 209 498 85 128 137 191 262 319 196 202 405 358 633 474 228 117 398 167 597 176l130 6-43 32c-23 17-64 36-90 43-48 11-49 11-85-24-47-44-94-59-168-54-194 14-261 270-101 383 89 62 231 40 291-46 23-33 34-39 93-53 71-16 176-64 197-90 8-9 18-16 24-16 7 0-22 34-63 76-301 304-705 456-1130 423z" />
                            <path d="m2152 2565c-87-37-84-154 5-191 31-14 38-13 71 3 23 11 44 32 55 55 16 32 16 40 4 70-25 59-81 85-135 63z" />
                            <path d="m2690 2416c0-2 8-10 18-17 15-13 16-12 3 4s-21 21-21 13z" />
                            <path d="m2756 2317c13-30 27-76 30-103 5-36 16-59 42-88 60-68 86-137 90-250 4-83 8-104 28-134 101-148 60-420-102-678-201-320-516-599-869-770-230-111-385-149-570-142-130 6-200 29-266 87-30 26-61 42-99 51-118 27-217 93-266 175-21 36-32 45-63 50-42 7-153 56-186 82-11 9 25-29 81-84 376-372 927-502 1431-337 418 136 771 489 907 907 111 339 88 721-63 1043-34 71-137 244-146 244-2 0 7-24 21-53z" />
                            <path d="m2370 2099c-158-17-384-102-575-216-496-298-865-755-919-1140l-6-42 57 5c126 11 116 4 157 104 59 141 148 277 286 435 228 261 582 501 885 600 86 28 211 55 253 55 27 0 30 4 51 73 24 82 27 116 9 121-32 10-130 12-198 5z" />
                            <path d="m2405 1775c-91-20-229-72-335-125-303-152-606-418-779-684-52-79-116-204-109-211 8-8 180 58 293 113 244 119 438 256 639 452 142 138 238 254 315 378 28 45 51 84 51 87 0 6-1 6-75-10z" />
                            <path d="m2676 1706c-152-299-452-617-806-854-210-140-493-270-707-322-41-10-42-11-36-48 3-20 7-39 9-41 11-13 175 3 256 23 156 40 191 57 198 92 24 113 149 169 250 113 106-60 106-228 0-288-42-23-114-28-154-10-20 9-40 6-118-21-51-18-133-41-182-51-48-10-90-20-93-22-9-10 85-21 164-19 378 5 942 357 1231 768 57 81 142 222 110 183-48-59-149-77-218-38-106 60-106 228 0 288 21 11 48 21 59 21 18 0 29 14 52 65 27 61 74 213 67 220-1 1-12 5-24 9-18 5-26-4-58-68z" />
                            <path d="m2876 1585c-4-16-22-62-40-101-27-57-31-75-22-90 6-10 13-41 16-69l5-50 24 68c28 82 41 178 32 232l-7 40z" />
                            <path d="m2640 1367c-46-24-42-90 6-108 27-9 64 9 75 37 17 47-36 93-81 71z" />
                            <path d="m502 1245c-87-37-84-154 5-191 31-14 38-13 71 3 23 11 44 32 55 55 16 32 16 40 4 70-25 59-81 85-135 63z" />
                            <path d="m1730 577c-46-24-42-90 6-108 27-9 64 9 75 37 17 47-36 93-81 71z" />
                            <path d="m960 495c0-2 14-11 30-20 29-15 30-15 30 5 0 16-7 20-30 20-16 0-30-2-30-5z" />
                        </g>
                    </svg>
                </div>
                <div class="card mt-4" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body">

                        <small id="emailHelp" class="form-text mb-1" style="color: red;">
                            <?= $_SESSION["VALIDATION_ERROR"]['login'] ?>
                        </small>

                        <form method="POST" action="<?= route('login') ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" autocomplete="off" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>
                            <div class="d-flex justify-content-end"><button type="submit" class="btn btn-secondary btn-sm text-rigth">LOGIN</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <div class="card mt-4" style="background-color: #fff; border: 0px; border-radius: 8px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                    <div class="card-body d-flex justify-content-center align-items-center">

                        <small id="emailHelp" class="form-text text-muted mb-1">We'll never share your email with anyone else.</small>

                        <a href="<?= route('register'); ?>" class="ml-2" style="font-size: 14px;">Register</a>

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