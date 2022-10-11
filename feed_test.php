<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/feed.php';
?>

<?php
if (is_user_logged_in()) {
    view('header_logged', ['title' => 'Feed']);
} else {
    view('header_incognito', ['title' => 'Feed']);
}
?>
<?php flash() ?>

<main>
    <div class="container-fluid justify-content-center posts-container" style="max-width: 600px; min-height: 2000px">
        <!-- ARTICLE 1 COMMENTS ARE HIDDEN -->
        <!-- <article class="card my-3 border border-light shadow-sm rounded-0 rounded-top">
            <div class="card-header">@alex</div>
            <div class="card-body p-0">
                <img src="http://localhost:8080/camagru/ilona/uploads/img_62d6ca64e688e.jpg" class="card-img-top rounded-0 picture" alt="..." />
            </div>
            <section class="card-body d-inline-flex justify-content-between py-0 px-1">
                <div class="">
                    <button href="#" class="btn pic-btn">
                        <svg aria-label="Like" class="heart" color="black" fill="black" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path>
                        </svg>
                    </button>
                    <button href="#" class="btn pic-btn">
                        <svg aria-label="Comment" class="bubble" color="black" fill="black" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <button href="#" class="btn pic-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                        </svg>
                    </button>
                </div>
            </section>
            <section class="card-body sec-likes p-0 pb-1 ps-3">
                <span class="text-start likes fw-bold m-0">2 like(s)</span>
            </section>
            <section class="card-body sec-comments p-0 pb-1 px-3">
                <span class="text-start comment-a float-start fw-bold m-0 pe-1">@aleksei</span>
                <span class="post-description">fdhbdfhgfdsghdrhgfdsgfdshjdgfarhtjyrtu,mtdyhrsgaefwdwqertwrayetsujrydktujhgsdfasathtsjdmnbgsfdsfatgshejrdymhnsdgsfearehsjtryhtgraf
                    fdsvfhggsdfgdgdsgdhdshdgshgdshdgshgdshdgshdsghdgshdghgdshgds
                    dgssdghs sghdfhgdsgh hsdhds dshsd</span>
                <p class="text-start m-0 my-1 text-muted">Show all comments</p>
            </section>
            <div class="card-footer text-muted bg-white ps-1 pe-0">
                <div class="comment-input input-group m-0 border-0">
                    <input type="text" class="form-control border-0" placeholder="Add a comment..." aria-label="Add comment" aria-describedby="button-addon2" />
                    <button class="btn text-muted fw-bold border-0" type="button" id="button-post">
                        Post
                    </button>
                </div>
            </div>
        </article> -->

        <!--    ARTICLE 2 WITH COMMENTS   -->
        <article class="card my-3 border border-light shadow-sm rounded-0 rounded-top">
            <div class="card-header">@alex</div>
            <div class="card-body p-0">
                <img src="http://localhost:8080/camagru/ilona/uploads/img_62d6ca64e688e.jpg" class="card-img-top rounded-0 picture" alt="..." />
            </div>
            <section class="card-body d-inline-flex justify-content-between py-0 px-1">
                <div class="">
                    <button href="#" class="btn pic-btn">
                        <svg aria-label="Like" class="heart" color="black" fill="black" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z"></path>
                        </svg>
                    </button>
                    <button href="#" class="btn pic-btn">
                        <svg aria-label="Comment" class="bubble" color="black" fill="black" height="24" role="img" viewBox="0 0 24 24" width="24">
                            <path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <button href="#" class="btn pic-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                        </svg>
                    </button>
                </div>
            </section>
            <section class="card-body sec-likes p-0 pb-1 ps-3">
                <span class="text-start likes fw-bold m-0">2 like(s)</span>
            </section>
            <section class="card-body sec-comments p-0">
                <div class="a-sec p-0 pb-1 px-3">
                    <span class="text-start comment-a float-start fw-bold m-0 pe-2">aleksei</span>
                    <span class="post-description">fdhbdfhgfdsghdrhgfdsgfdshjdgfarhtjyrtu,mtdyhrsgaefwdwqertwrayetsujrydktujhgsdfasathtsjdmnbgsfdsfatgshejrdymhnsdgsfearehsjtryhtgraf
                        fdsvfhggsdfgdgdsgdhdshdgshgdshdgshgdshdgshdsghdgshdghgdshgds
                        dgssdghs sghdfhgdsgh hsdhds dshsd</span>
                    <p class="text-start m-0 my-1 text-muted">Hide comments</p>
                </div>

                <div class="comments border-top border-1 pt-1">
                    <!-- COMMENT !/ DELETE B -->
                    <div class="comment container-fluid d-inline-flex align-items-center pe-0 mb-2">
                        <div class="comment-text pe-1 pe-3">
                            <span class="text-start comment-a float-start fw-bold m-0 pe-2">erik:</span>
                            <span class="post-description">gfdsfgf sgdg sgfdsgds gdfsgdfs sddgdsgds fdsgdfsg dsdfgfdsg
                                fdsgdfsgds dfgdfs sdgdfsg sdgdfsgfdsggd sbdss gdbg bgf
                                dbdgbfgdbgd shdssfgdfghdsf dsgdbgfvfdss dsgbgfvdfs bgbvd
                                bdsdbvfd fs</span>
                        </div>
                    </div>

                    <!-- COMMENT W/ DELETE B -->
                    <div class=" comment container-fluid d-inline-flex align-items-center pe-0 mb-2 ">
                        <div class="comment-text pe-1 border-end">
                            <span class="text-start comment-a float-start fw-bold m-0 pe-2">aleksei:</span>
                            <span class="post-description">scdfdbdndfhdgdsfsdgfdhfdjgfkglhkh,gmhngfsdsadsgdhgfdjfkglhl.,jmhngbdfvsdasafdgfhjfkghlkh;h.,mhngfdsdsfdghfdjkflg.,mnbfvsdsgfdghffgjkgkh,mhngdfsdfdsfdhjfk</span>
                        </div>
                        <button href="#" class="btn pic-btn comment-button px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class=" comment container-fluid d-inline-flex align-items-center pe-0 mb-2 ">
                        <div class="comment-text pe-1 pe-3">
                            <span class="text-start comment-a float-start fw-bold m-0 pe-2">vova:</span>
                            <span class="post-description">gfdsfgf sgdg sgfdsgds gdfsgdfs sddgdsgds fdsgdfsg dsdfgfdsg
                                fdsgdfsgds dfgdfs sdgdfsg sdgdfsgfdsggd sbdss gdbg bgf
                                dbdgbfgdbgd shdssfgdfghdsf dsgdbgfvfdss dsgbgfvdfs bgbvd
                                bdsdbvfd fs</span>
                        </div>
                    </div>
                    <div class=" comment container-fluid d-inline-flex align-items-center pe-0 mb-2 ">
                        <div class="comment-text pe-1 border-end">
                            <span class="text-start comment-a float-start fw-bold m-0 pe-2">aleksei:</span>
                            <span class="post-description">gfdsfgf sgdg sgfdsgds gdfsgdfs bdghhd hfd dss dsgbgfvdfs
                                bgbvd bdsdbvfd fs</span>
                        </div>
                        <button href="#" class="btn pic-btn comment-button px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class=" comment container-fluid d-inline-flex align-items-center pe-0 mb-2 ">
                        <div class="comment-text pe-1 pe-3">
                            <span class="text-start comment-a float-start fw-bold m-0 pe-2">ilona:</span>
                            <span class="post-description">gfdsfgf sgdg sgfdsgds gdfsgdfs sddgdsgds fdsgdfsg dsdfgfdsg
                                fdsgdfsgds dfgdfs sdgdfsg sdgdfsgfdsggd sbdss gdbg bgf
                                dbdgbfgdbgd shdssfgdfghdsf dsgdbgfvfdss dsgbgfvdfs bgbvd
                                bdsdbvfd fs</span>
                        </div>
                    </div>
                </div>
            </section>
            <div class="card-footer text-muted bg-white ps-1 pe-0">
                <div class="comment-input input-group m-0 border-0">
                    <input type="text" class="form-control border-0" placeholder="Add a comment..." aria-label="Add comment" aria-describedby="button-addon2" />
                    <button class="btn text-muted fw-bold border-0" type="button" id="button-pos2">
                        Post
                    </button>
                </div>
            </div>
        </article>

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link link-dark" href="#" aria-label="Previous" onclick=page_click(-1)>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link link-dark" href="#" onclick=page_click(0)>1</a></li>
            <li class="page-item">
                <a class="page-link link-dark" href="#" aria-label="Next" onclick=page_click(1)>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</main>
<?php view('footer') ?>

<script>
    const posts_container = document.querySelector(".posts-container");
    const parsedUrl = new URL(window.location.href);


    // console.log(parsedUrl);
    // posts_container.addEventListener("load", function() {
    //     fetch('http://localhost:8080/camagru/mine/feed_test.php')
    //         .then(function(response) {
    //             return response.text();
    //         })
    //         .then(function(body) {
    //             posts_container.appendChild(body);
    //         })
    //         .catch(function(error) {
    //             console.log(error);
    //         });
    // });

    // http://localhost:8080/camagru/mine/ajax_feed.php


    (() => {
        const formData = new FormData();
        fetch('http://localhost:8080/camagru/mine/feed_test.php', {
                method: 'POST'
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(body) {
                posts_container.innerHTML = body;
            })
            .catch(function(error) {
                console.log(error);
            });
    })();





    function page_click(to_page) {
        let page = <?= $page_no = 1; ?> + to_page;
        const formData = new FormData();
        const parsedUrl = new URL(window.location.href);
        formData.append('page', $page_no)
        fetch(parsedUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    // Find some way to get to execute .catch()
                    return Promise.reject('something went wrong!')
                }
            })
            .then((result) => {
                if (result.hasOwnProperty('error')) {
                    alert(result.error);
                } else if (result.hasOwnProperty('success')) {
                    alert(result.success);
                }
                console.log(result);

                //hide_by_class("modal_loader");
                //appendPhotoBar(result);
                //maybe add alert when loaded
                hide_by_class("thumb-loader");
            })
            .catch((error) => {
                console.error('Error:', error);
                hide_by_class("thumb-loader");
            });

    }
</script>