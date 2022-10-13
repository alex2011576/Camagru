<?php
//require_once __DIR__ . '/libs/image_checks.php';

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
    if (isset($_POST['image']) && isset($_POST['stickers']) && isset($_POST['description'])) {
        header("Content-Type: application/json; charset=UTF-8");
        $description = validate_description($_POST['description']);
        $data_url = $_POST['image'];
        $is_image = getimagesize($_POST['image']);
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
        if (isset($_POST['flip'])) {
            if (!imageflip($image_resource, IMG_FLIP_HORIZONTAL)) {
                echo json_encode(['error' => 'Something went wrong. Try again or peak another file, please!']);
                die();
            }
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
        $image_data = ob_get_contents();
        ob_end_clean();
        $final_destination = upload_dir . uniqid('img_') . '.jpg';
        // User-ID debugging
        // echo json_encode(['error' => $_SESSION['user_id']]);
        // die();
        save_post($image_data, $description, $_SESSION['user_id']);
        // save_post($image_data, $description, 2);

        if (!file_put_contents($final_destination, $image_data)) {
            echo json_encode(['error' => 'Something went wrong. Try again later!']);
            die();
        }
        $post_id = extract_last_post($_SESSION['user_id']);
        $response_image = "data:image/jpeg;base64," . base64_encode($image_data);
        //echo ($_POST['stickers']);
        echo json_encode([
            'success' => 'Photo has been uploaded successfully!',
            'image' => [
                'url' => $response_image,
                'post_id' => $post_id['post_id']
            ]
        ]);
        die();
    } else if (isset($_POST['post_id'])) {

        header("Content-Type: application/json; charset=UTF-8");
        $fields = [
            'post_id' => 'int | required'
        ];
        $errors = [];
        $inputs = [];
        [$inputs, $errors] = filter($_POST, $fields);
        if ($errors) {
            echo json_encode(['error' => $errors['post_id']]);
        }
        if (!delete_post($_SESSION['user_id'], $inputs['post_id'])) {
            echo json_encode(['error' => "Couldn't delete your post!"]);
            die();
        }
        echo json_encode(['success' => 'Post was deleted!']);
        die();
    }
} else if (is_get_request()) {
    $inputs = [];
    $errors = [];
    $inputs['thumbnail'] = extract_posts_by_id($_SESSION['user_id']);
    //var_dump($inputs);
    // foreach ($inputs['thumbnail'] as $key => $value) {
    //     die();

    // }
    if ($inputs['thumbnail'] === false) {
        redirect_with_message(
            'new_post.php',
            'Something went wrong! Please, log out and log-in again!',
            FLASH_ERROR
        );
        //$errors['thumbnail'] = "Couldn't get your posts!";
    } else {
        // var_dump($inputs);
        //die();
        foreach ($inputs['thumbnail'] as $post => $val) {
            $inputs['thumbnail'][$post]['post'] = "data:image/jpeg;base64," . base64_encode($val['post']);
        }
    }
    //extract_posts();
}

//To consider:
//I probalby should do try->catch and throw errors instead of echoing them one by one which reduces readibility
//Create unique post_id insted of autoincrementing


//echo ($_POST['stickers']);
// echo (json_encode($path));
// die();

// try {
//     throw new Exception("1111111 error message!!!!!!!!!!!!!");
// } catch (Exception $e) {
//     echo json_encode($e->getMessage());
//     die();
// }