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

function get_posts($offset, $row_limit)
{

    $sql = 'SELECT users.username, posts.post_id, 
            posts.owner_id, posts.post, 
            posts.post_description
            FROM posts 
            JOIN users ON posts.owner_id = users.user_id 
            ORDER BY posts.created_at DESC
            LIMIT :offset , :row_limit';

    $statement = db()->prepare($sql);
    $statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
    $statement->bindValue(':row_limit', (int) $row_limit, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function validate_description($text)
{
    if (!empty($text)) {
        //validate here!
        $description = $text;
        if (mb_strlen($description, "UTF-8") > 200) {
            echo json_encode(['error' => 'Description is too long! Sorry, try again']);
            die();
        }
        $description = htmlspecialchars($description);
    } else {
        $description = "";
    }
    return $description;
}

function save_post($image_data, $description, $post_owner)
{
    $user = find_user_by_username($_SESSION['username']);
    if ($user && is_user_active($user)) {
        if (!insert_post($image_data, $description, $post_owner)) {
            echo json_encode(['error' => 'Failed to upload your post! Please, try again!']);
            die();
        }
    } else {
        echo json_encode(['error' => 'We could not access your account data! You will be logged out!']);
        die();
    }
}

/**
 * Insert post to database
 *
 * @param string $image_data
 * @param string $description
 * @return bool
 */
function insert_post($image_data, $description, $owner_id): bool
{
    $sql = 'INSERT INTO posts(owner_id, post, post_description)
            VALUES(:owner_id, :post, :post_description)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':owner_id', $owner_id);
    $statement->bindValue(':post', $image_data, PDO::PARAM_LOB);
    $statement->bindValue(':post_description', $description);

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        die();
        //  die($e->getMessage());
    }
}

/**
 * 
 * Extract last post by user_id;
 * return asocciative array[post_id] or false.
 * 
 * @param $user_id
 * @return mixed
 */
function extract_last_post($user_id): mixed
{

    $sql = 'SELECT post_id
            FROM posts
            WHERE owner_id=:owner_id
            ORDER BY created_at DESC LIMIT 1';

    $statement = db()->prepare($sql);
    $statement->bindValue(':owner_id', $user_id);
    try {
        $statement->execute();
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        die();
        //  die($e->getMessage());
    }

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * 
 * Extract all posts by user_id;
 * return asocciative array['post_id', 'post'] 
 * containing post_id and blob or false
 * 
 * @param $user_id
 * @return mixed
 */
function extract_posts_by_id($user_id): mixed
{

    $sql = 'SELECT post_id, post
            FROM posts
            WHERE owner_id=:owner_id
            ORDER BY created_at DESC';

    $statement = db()->prepare($sql);
    $statement->bindValue(':owner_id', $user_id);
    try {
        $statement->execute();
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        die();
        //  die($e->getMessage());
    }

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function delete_post($user_id, $post_id): bool
{
    $sql = 'DELETE FROM posts
            WHERE owner_id = :owner_id AND post_id = :post_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':owner_id', $user_id);
    $statement->bindValue(':post_id', $post_id);

    return $statement->execute();
}

function is_owner($owner)
{
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        if ($owner == $_SESSION['username'])
            return true;
    }
    return false;
}
