<?php
$row_limit = 5;
$inputs = [];
$errors = [];
if (is_get_request()) {
    $stmt = db()->prepare("SELECT COUNT(*) FROM posts");
    $stmt->execute();
    $rows = $stmt->fetch();
    $total_pages = ceil($rows[0] / $row_limit);
}
if (is_post_request()) {
    if (isset($_POST["page"])) {
        $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($page_no)) {
            die("Error fetching data! Invalid page number!!!");
        }
        ob_clean();
        include __DIR__ . '/../ajax_feed.php';
        die();
        // get total no. of pages
    }
    if (isset($_POST["delete_post"]) && !empty($_POST["delete_post"])) {
        if (!delete_post($_SESSION['user_id'], $_POST['post_id'])) {
            echo json_encode(['error' => "Couldn't delete your post!"]);
            die();
        }
        echo json_encode(['success' => 'Post was deleted!']);
        die();
    }
    // if (isset($_POST["like"]) && !empty($_POST["like"])) {
    //     if (!put_like($_POST["post_id"], $_SESSION['user_id'])) {
    //         die("error");
    //     } else {
    //         $like_id = true;
    //         include __DIR__ . '/inc/like.php';
    //         die();
    //     }
    // }
    if (isset($_POST["comment"])) {
    }
    if (isset($_POST["like"]) && !empty($_POST["like"])) {
        $like_id = check_like($_POST['post_id'], $_SESSION['user_id']);
        if (!$like_id) {
            if (!put_like($_POST["post_id"], $_SESSION['user_id'])) {
                die("error");
            }
            $like_id = true;
        } else {
            if (!delete_like($like_id, $_SESSION['user_id'])) {
                die("error");
            }
            $like_id = false;
        }
        include __DIR__ . '/inc/like.php';
        die();
    }
    if (isset($_POST["delete_comment"]) && !empty($_POST["delete_comment"])) {
    }
    // get record starting position
    // $start = (($page_no - 1) * $row_limit);

    // $results = db()->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT $start, $row_limit");
    // $results->execute();

    // $results->fetchALL(PDO::FETCH_ASSOC);
}
