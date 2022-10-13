<?php

function load_comments($post_id)
{
    $sql = 'SELECT  users.username, comments.comment_id, 
        comments.post_id, comments.comment, comments.comment_owner_id 
        FROM comments 
        JOIN users ON comments.comment_owner_id = users.user_id
        WHERE comments.post_id = :post_id
        ORDER BY comments.created_at DESC';

    try {
        $stm = db()->prepare($sql);
        $stm->bindValue(':post_id', (int) $post_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchALL(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("error");
        // die('Error: ' . $e->getMessage());
        //  die($e->getMessage());
    }
}

function delete_comment($comment_id, $user_id)
{
    $sql = 'DELETE FROM comments
            WHERE comment_id = :comment_id AND comment_owner_id = :comment_owner_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->bindValue(':comment_owner_id', $user_id);

    return $statement->execute();
}

function add_comment($comment, $post_id, $user_id)
{
    $sql = 'INSERT INTO comments(post_id, comment, comment_owner_id)
            VALUES(:post_id, :comment, :comment_owner_id)';

    $statement = db()->prepare($sql);
    $statement->bindValue(':post_id', $post_id);
    $statement->bindValue(':comment', $comment);
    $statement->bindValue(':comment_owner_id', $user_id);

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        //son_encode(['error' => $e->getMessage()]);
        die("error");
    }
}

function validate_comment($text)
{
    if (!empty($text)) {
        //validate here!
        $comment = $text;
        if (mb_strlen($comment, "UTF-8") > 200) {
            die("limit");
        }
        $comment = htmlspecialchars($comment);
    } else {
        die("empty");
    }
    return $comment;
}

function send_notification($email, $commentator, $subject): void
{
    $feed_url = APP_URL . 'fdf.php';
    $message = <<<MESSAGE
            Your post just recieved new comment from the user @$commentator.
            You can check it out here: $feed_url
            MESSAGE;
    $header = 'From:' . SENDER_EMAIL_ADDRESS;
    mail($email, $subject, $message, $header);
}
