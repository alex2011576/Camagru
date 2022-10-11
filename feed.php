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
    <div class="d-flex flex-column align-items-center no-posts d-none" style="width:100%; margin-top:30%; min-height: 500px">
        <h3>No posts here yet!</h3>
        <h5 class="mt-3"> Do you want to be the first one ? </h5>
    </div>
    <div class="container-fluid justify-content-center posts-container" style="max-width: 600px; min-height: 2000px">
    </div>
    <nav aria-label="Page navigation" class="page-navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link link-dark" href="#" aria-label="Previous" onclick=page_click(-1)>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link link-dark" href="#" id="current-page" onclick=page_click(0)>1</a></li>
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
    let page_no = 1;

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
        formData.append('page', 1);
        fetch('http://localhost:8080/camagru/mine/feed.php', {
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
                if (result !== "no change" && result !== "no posts") {
                    let page = document.getElementById('current-page');
                    posts_container.innerHTML = result;
                    page.innerHTML = page_no;
                    display_by_class('posts-container');
                    display_by_class('page-navigation');
                    hide_by_class('no-posts');
                } else if (result === "no posts") {
                    display_by_class('no-posts');
                    hide_by_class('posts-container');
                    hide_by_class('page-navigation');
                }
            })
            .catch((error) => {});
    })();


    function page_click(to_page) {
        const formData = new FormData();
        const parsedUrl = new URL(window.location.href);
        page_no += to_page;
        if (page_no < 1) {
            page_no = 1;
        }
        formData.append('page', page_no)
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
                if (result !== "no change" && result !== "no posts") {
                    let page = document.getElementById('current-page');
                    posts_container.innerHTML = result;
                    page.innerHTML = page_no;
                    display_by_class('posts-container');
                    display_by_class('page-navigation');
                } else if (result === "no posts") {
                    display_by_class('no-posts');
                    hide_by_class('posts-container');
                    hide_by_class('page-navigation');
                } else {
                    page_no -= 1;
                }
            })
            .catch((error) => {});

    }

    function delete_post(element) {
        let id = element.getAttribute('data-post-id');
        const parsedUrl = new URL(window.location.href);
        const formData = new FormData();
        let article = document.querySelector(`article[data-post-id="${id}"]`);
        article.classList.add('d-none');
        formData.append('delete_post', 1);
        formData.append('post_id', id);
        fetch(parsedUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json()
                } else {
                    return Promise.reject('something went wrong!')
                }
            })
            .then((result) => {
                if (result.hasOwnProperty('error')) {
                    alert(result.error);
                    article.classList.remove('d-none');
                } else if (result.hasOwnProperty('success')) {
                    article.remove();
                }
                console.log(result);
            })
            .catch((error) => {
                console.error('Error:', error);
                article.classList.remove('d-none');
            });
    }
</script>