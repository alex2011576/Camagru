<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}

if (is_post_request()) {
    header("Content-Type: application/json; charset=UTF-8");
    // echo json_encode($_REQUEST);
    // echo json_encode($_FILES);
    // var_dump($_FILES);
    //$test = utf8_encode($_POST['stikers']);

    // $jsonStr = json_decode($_POST['stickers']);
    // $data['model'] = "box1";
    // $data = json_encode($data);
    //echo $data;
    //var_dump($_FILES);
    //var_dump($_POST);
    $jsonARR = json_decode($_POST['stickers'], true);
    $jsonARR['model'] = "boxxx11";
    $data = json_encode($jsonARR);
    echo ($data);
    die();
}
