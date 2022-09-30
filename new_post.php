<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/new_post.php';
?>

<?php view('header_logged', ['title' => 'New Post']) ?>
<?php flash() ?>

<main class="" style="width: 100%">


    <div class="container-fluid d-flex justify-content-center">

        <div class="container mt-2 p-0 mx-0 mx-md-3">
            <div class="row g-5">
                <div class="col-12 col-md-8">
                    <div class="p-0 p-md-3  border shadow-sm rounded-0 bg-light">
                        <div class="d-flex justify-content-center flex-wrap">

                            <div class="upload_element">
                                <p class="text text-center font-upload fw-bold py-2 my-2" style="width: inherit">
                                    Take or upload a picture
                                </p>
                            </div>
                            <img src="http://localhost:8080/camagru/ilona/uploads/img_62d6ca64e688e.jpg" class="rounded-0  picture" alt="..." />


                            <div class="upload_element">
                                <p class="text text-center fw-bold pt-2 pb-0 mt-2 mb-0" style="width: inherit">
                                    Choose stickers
                                </p>
                            </div>
                            <div class="scrollmenu bg-light my-0 mb-2 p-2">
                                <img class="sticker img-thumbnail" id="stick1" onclick="selectSticker(1)" src="./static/stickers/1.png" alt="">
                                <img class="sticker img-thumbnail" id="stick2" onclick="selectSticker(2)" src="./static/stickers/2.png" alt="">
                                <img class="sticker img-thumbnail" id="stick3" onclick="selectSticker(3)" src="./static/stickers/3.png" alt="">
                                <img class="sticker img-thumbnail" id="stick4" onclick="selectSticker(4)" src="./static/stickers/4.png" alt="">
                                <img class="sticker img-thumbnail" id="stick5" onclick="selectSticker(5)" src="./static/stickers/5.png" alt="">
                                <img class="sticker img-thumbnail" id="stick6" onclick="selectSticker(6)" src="./static/stickers/6.png" alt="">
                                <img class="sticker img-thumbnail" id="stick7" onclick="selectSticker(7)" src="./static/stickers/7.png" alt="">
                                <img class="sticker img-thumbnail" id="stick8" onclick="selectSticker(8)" src="./static/stickers/8.png" alt="">
                            </div>
                            <div class="bg-light">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-3 border bg-light">
                        Custom column padding
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php view('footer') ?>