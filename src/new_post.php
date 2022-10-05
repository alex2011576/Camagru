<?php
require_once __DIR__ . '/libs/image_checks.php';

if (!is_user_logged_in()) {
    redirect_to('login.php');
}
const allowedTypes = [
    'data:image/png' => 'png',
    'data:image/jpeg' => 'jpg'
];
const sticker_dir = __DIR__ . '/../static/stickers/';
const upload_dir = __DIR__ . '/../static/uploaded/';

if (is_post_request()) {
    if (isset($_POST['image']) && isset($_POST['stickers'])) {

        //header("Content-Type: application/json; charset=UTF-8");
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
        $data_url = $_POST['image'];
        $is_image = getimagesize($_POST['image']);
        // try {
        //     throw new Exception("1111111 error message!!!!!!!!!!!!!");
        // } catch (Exception $e) {
        //     echo json_encode($e->getMessage());
        //     die();
        // }
        if (!$is_image) {
            echo json_encode(['error' => 'File is not an image. Only png and jpeg are supported!']);
            die();
        }
        list($type, $data) = explode(';', $data_url);
        if (!in_array($type, array_keys(allowedTypes))) {
            echo json_encode(['error' => 'Wrong file format, only png and jpeg are supported!']);
            die();
        }
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $image_resource = imagecreatefromstring($data);
        if (!$image_resource) {
            echo json_encode(['error' => 'Something went wrong. Try again or peak another file, please!']);
            die();
        }
        $stickers = json_decode($_POST['stickers'], true);
        foreach ($stickers as $sticker => $value) {
            $path =  sticker_dir . $sticker . '.png';
            $h_offset = $value['y'];
            $v_offset = $value['x'];
            $sticker_data = file_get_contents($path);
            if (!$sticker_data) {
                echo json_encode(['error' => 'Sorry, sticker is not avaliable']);
                die();
            }
            $sticker_gd = imagecreatefromstring($sticker_data);
            $width = imagesx($sticker_gd);
            $height = imagesy($sticker_gd);
            // $destination = upload_dir . $sticker . '.png';
            // file_put_contents($destination, $sticker_data);
            imagecopy($image_resource, $sticker_gd, $v_offset, $h_offset, 0, 0, $width, $height);
        }
        ob_start();
        if (!imagejpeg($image_resource, null, 100)) {
            echo json_encode(['error' => 'Something went wrong. Try again later!']);
            die();
        }
        $image_data = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer
        $final_destination = upload_dir . uniqid('img_') . '.jpg';
        if (!file_put_contents($final_destination, $image_data)) {
            echo json_encode(['error' => 'Something went wrong. Try again later!']);
            die();
        }
        //echo ($_POST['stickers']);
        echo json_encode(['success' => 'Photo has been uploaded successfully!']);
        die();
    }
}

//echo ($_POST['stickers']);
// echo (json_encode($path));
// die();