
<?php
require __DIR__ . '/src/bootstrap.php';

if (is_post_request()) {
    header("Content-Type: application/json; charset=UTF-8");
    // echo json_encode($_REQUEST);
    // echo json_encode($_FILES);
    // var_dump($_FILES);
    //$test = utf8_encode($_POST['stikers']);
    $data = json_decode($_POST['stickers']);
    echo $data;
    //exit();
}
