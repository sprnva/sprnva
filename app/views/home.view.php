<?php

use App\Core\Auth;
use App\Core\Request;

require 'layouts/head.php'; ?>

<style>
    .wlcm-link {
        text-decoration: underline !important;
        color: inherit;
    }

    .welcome-msg {
        margin-top: 10%;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <h2 class="mb-0 text-muted welcome-msg">Welcome to your Sprnva application</h2>
            <p class="text-muted">We can't wait to see what you build</p>
        </div>
    </div>
</div>

<?php require 'layouts/footer.php'; ?>