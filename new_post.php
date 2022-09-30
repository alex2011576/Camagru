<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/new_post.php';
?>

<?php view('header_logged', ['title' => 'Settings']) ?>
<?php flash() ?>