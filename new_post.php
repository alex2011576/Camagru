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
                        <form class="d-flex justify-content-center flex-wrap">

                            <div class="upload_element border-bottom ">
                                <p class="text text-center font-upload fw-bold py-2 my-2" style="width: inherit">
                                    Take or upload a picture
                                </p>
                            </div>
                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2" id="open_web">Webcam</button>
                                <div class="or">OR</div>
                                <label for="pic-upload" class="btn btn-sm btn-dark post-btn m-2">
                                    Upload
                                </label>
                                <input class="d-none" type="file" accept="image/png, image/jpeg" id="pic-upload" name="file">
                            </div>
                            <!-- <img src="http://localhost:8080/camagru/ilona/uploads/img_62d6ca64e688e.jpg" class="d-none rounded-0  picture" alt="..." /> -->

                            <!-- The part below appears when either webcam or upload is chosen -->
                            <div class="d-flex justify-content-center" style="width: 100%">
                            </div>

                            <div class="d-flex justify-content-center flex-wrap m-1 toggle-upload d-none " style="width: 100%">
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <canvas class="toggle-upload canvas-upload d-none my-1 border-0 " id="canvas"></canvas>
                                </div>
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <input type="text" class="form-control my-1 border-0 rounded-0" name="description" id="description" value="" placeholder="Add description: " autocomplete="off" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload d-none" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2" id="btn-post" type="submit">Post</button>
                                <div class="or">OR</div>
                                <button class="btn btn-sm btn-danger post-btn m-2" id="btn-cancel" type="reset">Cancel</button>
                            </div>

                            <!-- 
                            <div class="upload_element border-top">
                                <p class="text text-center fw-bold pt-2 pb-0 mt-2 mb-0 " style="width: inherit">
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
                            </div> -->
                            <div class="bg-light">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-3 border bg-light">
                        Previously posted
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php view('footer') ?>
<!-- UPLOAD Canvas script -->
<script>
    const pic = new Image(); // Create new pic element
    const image_input = document.querySelector("#pic-upload");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    pic.addEventListener('load', () => {
        // execute drawImage statements here
        canvas.width = pic.naturalWidth;
        canvas.height = pic.naturalHeight;
        ctx.drawImage(pic, 0, 0);

        adjust_decription(pic.naturalWidth + 2);
        toggle_on_upload();

    }, false);


    image_input.addEventListener("change", function() {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            pic.src = uploaded_image;
        });
        reader.readAsDataURL(this.files[0]);
    });

    // function drawImageScaled(img, ctx) {
    //     var canvas = ctx.canvas;
    //     var hRatio = canvas.width / img.width;
    //     var vRatio = canvas.height / img.height;
    //     var ratio = Math.min(hRatio, vRatio);
    //     var centerShift_x = (canvas.width - img.width * ratio) / 2;
    //     var centerShift_y = (canvas.height - img.height * ratio) / 2;
    //     ctx.clearRect(0, 0, canvas.width, canvas.height);
    //     ctx.drawImage(img, 0, 0, img.width, img.height,
    //         centerShift_x, centerShift_y, img.width * ratio, img.height * ratio);
    // }
</script>
<!-- UPLOAD-TOGGLE-->
<!-- <script>
    const btn = document.getElementById('pic-upload');

    btn.addEventListener('click', () => {
        const boxes = document.getElementsByClassName('toggle-upload');

        for (const box of boxes) {
            // 👇️ Remove element from DOM
            box.class.display = 'none';

            // 👇️ hide element (still takes up space on page)
            // box.style.visibility = 'hidden';
        }
    });
</script> -->
<script>
    function adjust_decription(target_width) {
        const description = document.getElementById("description");
        description.style.width = `${target_width}px`;
    }

    function toggle_on_upload() {
        const boxes = document.getElementsByClassName('toggle-upload');

        for (const box of boxes) {
            box.classList.toggle('d-none');
        }
    }
</script>