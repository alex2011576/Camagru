<?php
$stmt = db()->prepare("SELECT COUNT(*) FROM posts");
$stmt->execute();
$rows = $stmt->fetch();
$total_pages = ceil($rows[0] / $row_limit);
if ($total_pages == 0) {
    header("Content-Type: text/plain");
    echo "no posts";
    die();
}
if (($page_no > $total_pages) || ($page_no < 1)) {
    header("Content-Type: text/plain");
    echo "no changes";
    die();
}

$offset = ($page_no - 1) * $row_limit;
$articles = get_posts($offset, $row_limit);
// set logged check before
// var_dump($articles);
// die();

foreach ($articles as $article => $values) {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $likes = load_likes($values['post_id'], $_SESSION['user_id']);
        $comments = load_comments($values['post_id']);
    } else {
        $likes = load_likes($values['post_id'], 0);
        $comments = [];
    }
    if ($likes['like_id'] !== 0) {
        $color = "red";
        $color_hidden = "black";
        $switch_on = 1;
    } else {
        $color = "black";
        $color_hidden = "red";
        $switch_on = 0;
    }
?>
    <article class="card my-3 border border-light shadow-sm rounded-0 rounded-top" data-post-id="<?= $values['post_id'] ?>">
        <div class="card-header">@<?= $values['username'] ?></div>
        <div class="card-body p-0">
            <img src="<?= "data:image/jpeg;base64," . base64_encode($values['post']) ?>" class="card-img-top rounded-0 picture" alt="..." />
        </div>
        <section class="card-body d-inline-flex justify-content-between py-0 px-1">
            <div class="">
                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) : ?>
                    <button class="btn pic-btn" data-post-id="<?= $values['post_id'] ?>" onclick=toggle_like(this)>
                    <?php else : ?>
                        <button class="btn pic-btn" data-post-id="<?= $values['post_id'] ?>" onclick=login_alert();>
                        <?php endif; ?>
                        <svg aria-label="Like" class="heart" color="<?= $color ?>" fill="<?= $color ?>" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path>
                        </svg>
                        <svg aria-label="Like" class="heart d-none" color="<?= $color_hidden ?>" fill="<?= $color_hidden ?>" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path>
                        </svg>
                        </button>
                        <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) : ?>
                            <button class="btn pic-btn" data-post-id="<?= $values['post_id'] ?>" onclick=focus_comment(this)>
                            <?php else : ?>
                                <button class="btn pic-btn" onclick=login_alert();>
                                <?php endif; ?>
                                <svg aria-label="Comment" class="bubble" color="black" fill="black" height="24" role="img" viewBox="0 0 24 24" width="24">
                                    <path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                                </button>
            </div>
            <?php if (is_owner($values['username'])) : ?>
                <div>
                    <button href="#" data-post-id="<?= $values['post_id'] ?>" data-post-id="<?= $values['post_id'] ?>" class="btn pic-btn" onclick="delete_post(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </section>
        <section class="card-body sec-likes p-0 pb-1 ps-3">
            <span class="text-start likes fw-bold m-0" data-post-id="<?= $values['post_id'] ?>" data-switch-on="<?= $switch_on ?>"><?= $likes['count'] ?> like(s)</span>
        </section>
        <section class="card-body sec-comments p-0">
            <div class="a-sec p-0 pb-1 px-3" style="height:fit-content; ">
                <!-- <span class="text-start comment-a float-start fw-bold m-0 pe-2"><?= $values['username'] ?></span> -->
                <span class="text-start comment-a fw-bold m-0 pe-2"><?= $values['username'] ?></span>
                <span class="post-description" style="width:100%"><?= $values['post_description'] ?></span>
            </div>
            <!-- <div class="px-3" style="width:100%">
                <p class="text-start m-0 my-1 text-muted">Hide comments</p>
            </div> -->
            <!-- Actual comments section  ADD IF (!EMPTY())-->
            <?php if (is_user_logged_in()) : ?>
                <div class="comments border-top border-1 py-1 bg-light" data-post-id="<?= $values['post_id'] ?>">
                <?php else : ?>
                    <div class="comments border-top border-1 pt-1 bg-light d-none" data-post-id="<?= $values['post_id'] ?>">
                    <?php endif; ?>
                    <!-- COMMENTS! -->
                    <?php foreach ($comments as $comment => $c_val) { ?>
                        <div class="comment container-fluid d-inline-flex align-items-center justify-content-between pe-0 mb-1 my-1 pt-0" data-comment-id="<?= $c_val['comment_id'] ?>">
                            <div class="comment-text pe-1 me-1">
                                <span class="text-start comment-a float-start fw-bold m-0 pe-2"><?= $c_val['username'] ?>:</span>
                                <span class="post-description"><?= $c_val['comment'] ?></span>
                            </div>
                            <?php if (is_owner($c_val['username'])) : ?>
                                <button class="btn pic-btn comment-button p-0 border me-2" data-comment-id="<?= $c_val['comment_id'] ?>" onclick=delete_comment(this)>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                                    </svg>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                    </div>
        </section>
        <div class="card-footer text-muted bg-white ps-1 pe-0">
            <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) : ?>
                <form class="comment-input input-group m-0 border-0" action="" method="post">
                    <input type="text" class="form-control border-0" maxlength="200" data-post-id="<?= $values['post_id'] ?>" placeholder="Add a comment..." aria-label="Add comment" autocomplete="off" required />
                    <button class="btn text-muted fw-bold border-0" type="submit" data-post-id="<?= $values['post_id'] ?>" onclick=add_comment(this)>
                        Post
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </article>
<?php
}
