<?php require __DIR__ . '/../layouts/head.php';

use App\Core\App; ?>

<h1>Users Page</h1>

<?php foreach ($users as $user) : ?>
    <a href="<?= route('users/detail', $user->id) ?>">
        <li><?php echo $user->fullname; ?></li>
    </a>
<?php endforeach; ?>

<form method="POST" action="<?= App::get('base_url') ?>/users">
    <input type="text" name="name">

    <button type="submit">Submit</button>

</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>