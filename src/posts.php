<?php
function get_post_owner($post_id)
{
    $sql = 'SELECT owner_id
            FROM posts
            WHERE post_id = :post_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':post_id', $post_id);
    try {
        $statement->execute();
        return $statement->fetchColumn();
    } catch (PDOException $e) {
        die();
        // echo json_encode(['error' => $e->getMessage()]);
        //  die($e->getMessage());
    }
}
