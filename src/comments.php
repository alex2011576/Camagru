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
        die('Error: ' . $e->getMessage());
        //  die($e->getMessage());
    }
}
