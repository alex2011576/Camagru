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
                        <form class="d-flex justify-content-center flex-wrap" method="POST" enctype="multipart/form-data">

                            <div class="upload_element border-bottom ">
                                <p class="text text-center font-upload fw-bold py-2 my-2" style="width: inherit">
                                    Take or upload a picture
                                </p>
                            </div>
                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2" id="open_web" type="button">Webcam</button>
                                <div class="or">OR</div>
                                <label for="pic-upload" class="btn btn-sm btn-dark post-btn m-2">
                                    Upload
                                </label>
                                <input class="d-none" type="file" accept="image/png, image/jpeg" id="pic-upload" name="file">
                            </div>

                            <!-- The part below appears when either webcam or upload is chosen -->
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border toggle-loader d-none m-5" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <!-- CANVAS -->
                            <div class="d-flex justify-content-center flex-wrap m-1 toggle-upload d-none " style="width: 100%">
                                <video class="d-none" id="video" style="width: 100%" autoplay></video>
                                <!-- <video class="toggle-upload toggle-web" id="video" style="width: 100%" autoplay></video> -->
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class=" canvas-upload my-1 border-0 " id="canvas-stickers"></canvas> -->
                                    <canvas class="toggle-upload d-none canvas-upload my-1 border-0 " id="canvas-stickers"></canvas>
                                </div>
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class=" canvas-upload my-1 border-0 " id="canvas"></canvas> -->
                                    <canvas class="canvas-upload d-none my-1 border-0 " id="canvas"></canvas>
                                </div>
                                <!-- STICKERS -->
                                <div class="d-flex justify-content-center flex-wrap" id="description" style="width: 100%;">
                                    <div class="scrollmenu bg-light my-0 mb-2 px-2 toggle-upload d-none" style="width: 100%;">
                                        <img class="sticker img-thumbnail" id="stick1" onclick="selectSticker(1)" src="./static/stickers/1.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick2" onclick="selectSticker(2)" src="./static/stickers/2.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick3" onclick="selectSticker(3)" src="./static/stickers/3.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick4" onclick="selectSticker(4)" src="./static/stickers/4.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick5" onclick="selectSticker(5)" src="./static/stickers/5.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick6" onclick="selectSticker(6)" src="./static/stickers/6.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick7" onclick="selectSticker(7)" src="./static/stickers/7.png" alt="">
                                        <img class="sticker img-thumbnail" id="stick8" onclick="selectSticker(8)" src="./static/stickers/8.png" alt="">
                                    </div>
                                    <input type="text" class="form-control my-1 border-0 rounded-0" name="description" id="description-input" value="" placeholder="Add description: " autocomplete="off" />
                                </div>
                            </div>

                            <!-- <div class="d-flex justify-content-center align-items-center m-1 toggle-upload d-none" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2" id="btn-post" type="button">Post</button>
                                <div class="or">OR</div>
                                <button class="btn btn-sm btn-danger post-btn m-2" id="btn-cancel" type="reset">Cancel</button>
                            </div> -->

                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload d-none" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2 d-none toggle-web" id="btn-shot" type="button">Shoot</button>
                                <button class="btn btn-sm btn-dark post-btn m-2 toggle-web" id="btn-post" type="button">Post</button>
                                <div class="or">OR</div>
                                <button class="btn btn-sm btn-danger post-btn m-2 d-none toggle-web" id="btn-cancel" type="reset">Cancel</button>
                                <button class="btn btn-sm btn-danger post-btn m-2 toggle-web" id="btn-retry" type="button">Retry</button>
                            </div>


                            <!-- <div class="upload_element border-top">
                                <p class="text text-center fw-bold pt-2 pb-0 mt-2 mb-0 " style="width: inherit">
                                    Choose stickers
                                </p>
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
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const canvas_stickers = document.getElementById("canvas-stickers");
    const ctx_stickers = canvas_stickers.getContext("2d");
    const pic = new Image(); // Create new pic element
    const image_input = document.querySelector("#pic-upload");
    const button_cancel = document.getElementById('btn-cancel');
    const button_post = document.getElementById('btn-post');
    const button_webcam = document.querySelector("#open_web");
    const video = document.querySelector("#video");
    const button_shot = document.querySelector("#btn-shot");


    pic.addEventListener('load', () => {
        // execute drawImage statements here
        //image_input.disabled = true;
        canvas.width = pic.naturalWidth;
        canvas.height = pic.naturalHeight;
        canvas_stickers.width = pic.naturalWidth;
        canvas_stickers.height = pic.naturalHeight;
        ctx.drawImage(pic, 0, 0);
        ctx_stickers.drawImage(pic, 0, 0);

        adjust_decription(pic.naturalWidth + 2);
        toggle_by_class('toggle-upload');

    }, false);


    image_input.addEventListener("change", function() {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            pic.src = uploaded_image;
        });
        reader.readAsDataURL(this.files[0]);
    });

    button_cancel.addEventListener("click", function() {
        console.log("HERE");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx_stickers.clearRect(0, 0, canvas.width, canvas.height);
        stream = video.srcObject;
        tracks = stream.getTracks();
        tracks.forEach(function(track) {
            track.stop();
        });
        //turn off webcam here
        toggle_by_class('toggle-upload');
    });

    // BTN-POST CLICK
    button_post.addEventListener("click", function() {

        const formData = new FormData();
        const fileField = document.querySelector('input[type="file"]');
        //formData.append('stickers', stickers_data);

        const foo = {
            foundation: "Mozilla",
            model: "box",
            week: 45,
            transport: "car",
            month: 7,
        };
        console.log(foo);
        console.log(JSON.stringify(foo));
        formData.append('stickers', JSON.stringify(foo));
        formData.append('avatar', fileField.files[0]);


        //const parsedUrl = new URL(window.location.href);
        //console.log(parsedUrl);

        fetch('http://localhost:8080/camagru/mine/new_post.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json()
                } else {
                    // Find some way to get to execute .catch()
                    return Promise.reject('something went wrong!')
                }
            })
            .then((result) => {
                console.log(result);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });

    button_webcam.addEventListener('click', async function() {
        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            })
            .then((stream) => {
                video.srcObject = stream;
                video.play();
                // toggle_by_class('toggle-upload');
                // toggle_by_class('toggle-web');
            })
            .catch((err) => {
                console.error(`An error occurred: ${err}`);
            });
        toggle_by_class('toggle-loader');
    });

    video.addEventListener('canplay', (ev) => {
        toggle_by_class('toggle-loader');
        toggle_by_class('toggle-upload');
        toggle_by_class('toggle-web');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas_stickers.width = video.videoWidth;
        canvas_stickers.height = video.videoHeight;
    }, false);

    video.addEventListener('play', () => {
        (function loop() {
            if (video.paused)
                return;
            ctx.drawImage(video, 0, 0);
            ctx_stickers.drawImage(video, 0, 0);
            setTimeout(loop, 1000 / 80); //fps
            console.log(1);
        })();
    }, false);

    button_shot.addEventListener('click', (ev) => {
        takepicture();
        ev.preventDefault();
    }, false);

    function takepicture() {
        toggle_by_class('toggle-web');
        // console.log(video.videoWidth);
        // console.log(video.videoHeight);
        ctx_stickers.drawImage(video, 0, 0);
        ctx.drawImage(video, 0, 0);
        video.pause();
        stream = video.srcObject;
        tracks = stream.getTracks();
        tracks.forEach(function(track) {
            track.stop();
        });

        adjust_decription(video.videoWidth + 2);
        let image_data_url = canvas.toDataURL('image/jpeg');

        // data url of the image
        console.log(image_data_url);
    };
</script>

<!-- Helpers functions -->
<script>
    function adjust_decription(target_width) {
        const description = document.getElementById("description");
        description.style.width = `${target_width}px`;
    }

    function toggle_by_class(class_name) {
        const boxes = document.getElementsByClassName(class_name);

        for (const box of boxes) {
            box.classList.toggle('d-none');
        }
    }

    // const button = document.getElementById('btn-cancel');
    // button.addEventListener('click', cancel_post(ctx));

    // function cancel_post(ctx) {
    //     //button.disabled = true;
    //     ctx.clearRect(0, 0, canvas.width, canvas.height);
    //     //toggle_on_upload();
    //     // setTimeout(() => {
    //     //     button.disabled = false;
    //     // }, 2000);
    // }

    function cancel_post(ctx) {
        //button.disabled = true;
        //toggle_on_upload();
        // setTimeout(() => {
        //     button.disabled = false;
        // }, 2000);
    }
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