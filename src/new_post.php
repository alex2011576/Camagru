<?php
require_once __DIR__ . '/libs/image_checks.php';

if (!is_user_logged_in()) {
    redirect_to('login.php');
}
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
        list($type, $data) = explode(';', $data_url);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        //die();
        //file_put_contents('./../static/uploaded/final.jpg', $data);
        $image_resource = imagecreatefromstring($data);
        $stickers = json_decode($_POST['stickers'], true);
        foreach ($stickers as $sticker => $value) {
            // $path = './../static/stickers/' . $sticker . '.png';
            $path =  sticker_dir . $sticker . '.png';

            //echo ($_POST['stickers']);
            // echo (json_encode($path));
            // die();
            $h_offset = $value['y'];
            $v_offset = $value['x'];
            $sticker_data = file_get_contents($path);
            //$sticker_data = file_get_contents('./../static/stickers/1.png');
            $sticker_gd = imagecreatefromstring($sticker_data);

            $width = imagesx($sticker_gd);
            $height = imagesy($sticker_gd);
            $destination = upload_dir . $sticker . '.png';
            // file_put_contents('./../static/uploaded/test.png', $sticker_data);
            file_put_contents($destination, $sticker_data);
            //$sticker = imagescale($sticker, $width, $height);
            imagecopy($image_resource, $sticker_gd, $v_offset, $h_offset, 0, 0, $width, $height);
            //file_put_contents('./../static/uploaded/final.jpg', $data);
        }
        ob_start();
        imagejpeg($image_resource, null, 100);
        $image_data = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer
        $final_destination = upload_dir . uniqid('img_') . '.jpg';
        file_put_contents($final_destination, $image_data);
        echo ($_POST['stickers']);
        die();
    }
}
