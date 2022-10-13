

<?php

function load_likes($post_id, $user_id)
{
    $sql1 = 'SELECT COUNT(like_id) FROM likes
                WHERE post_id = :post_id';
    $sql2 = 'SELECT like_id FROM likes
                WHERE post_id = :post_id AND user_id = :user_id';
    // 'SELECT like_id lokes.post_id, 
    //         posts.owner_id, posts.post, 
    //         posts.post_description
    //         FROM posts 
    //         JOIN users ON posts.owner_id = users.user_id 
    //         ORDER BY posts.created_at DESC
    //         LIMIT :offset , :row_limit';

    try {
        $count = db()->prepare($sql1);
        $count->bindValue(':post_id', (int) $post_id, PDO::PARAM_INT);
        $count->execute();
        $count = $count->fetchColumn();
        if ($count === false) {
            $count = 0;
        }
        if (isset($user_id) && !empty($user_id)) {

            $liked = db()->prepare($sql2);
            $liked->bindValue(':post_id', (int) $post_id, PDO::PARAM_INT);
            $liked->bindValue(':user_id', (int) $user_id, PDO::PARAM_INT);
            $liked->execute();
            $liked = $liked->fetchColumn();
            if ($liked === false) {
                $liked = 0;
            }
        } else {
            $liked = 0;
        }
        return ([
            'like_id' => $liked,
            'count' => $count
        ]);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
        //  die($e->getMessage());
    }
}

function check_like($post_id, $user_id)
{
    $sql = 'SELECT like_id FROM likes
            WHERE post_id = :post_id AND user_id = :user_id';

    try {

        if (isset($user_id) && !empty($user_id)) {

            $liked = db()->prepare($sql);
            $liked->bindValue(':post_id', (int) $post_id, PDO::PARAM_INT);
            $liked->bindValue(':user_id', (int) $user_id, PDO::PARAM_INT);
            $liked->execute();
            return $liked->fetchColumn();
        }
        return false;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
function delete_like($like_id, $user_id)
{
    $sql = 'DELETE FROM likes
            WHERE user_id = :owner_id AND like_id = :like_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':owner_id', $user_id);
    $statement->bindValue(':like_id', $like_id);

    return $statement->execute();
}

function put_like($post_id, $user_id)
{
    if (!isset($user_id) || !isset($post_id)) {
        return false;
    }

    $sql = 'INSERT INTO likes(post_id, user_id)
            VALUES(:post_id, :user_id)';

    $statement = db()->prepare($sql);
    $statement->bindValue(':post_id', $post_id);
    $statement->bindValue(':user_id', $user_id);

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        // echo json_encode(['error' => $e->getMessage()]);
        die();
        //  die($e->getMessage());
    }
}
?>

