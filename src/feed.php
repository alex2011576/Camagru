<?php
$row_limit = 5;
$inputs = [];
$errors = [];
// if (!is_user_logged_in()) {
//     $inputs['logged'] = false;
//     if (is_post_request()) {
//     }


//     if (is_get_request()) {
//         //$inputs['posts'] = get_posts();
//     }
// } else {
//     $inputs['logged'] = true;
//     if (is_post_request()) {
//     }



//     if (is_get_request()) {
//         // $inputs['posts'] = get_posts();
//     }
// }

if (is_get_request()) {
}
if (is_post_request()) {

    if (isset($_POST["page"])) {
        $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($page_no))
            die("Error fetching data! Invalid page number!!!");
    } else {
        $page_no = 1;
        include __DIR__ . '/../ajax_feed.php';
        die();
    }

    // get record starting position
    // $start = (($page_no - 1) * $row_limit);

    // $results = db()->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT $start, $row_limit");
    // $results->execute();

    // $results->fetchALL(PDO::FETCH_ASSOC);
}
