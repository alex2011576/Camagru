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
                            <div class="d-flex justify-content-center align-items-center m-1 btns-menu" style="width: 100%">
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
                            <div class="d-flex justify-content-center flex-wrap m-1 toggle-upload toggle-web d-none " style="width: 100%">
                                <video class="d-none" id="video" style="width: 100%" autoplay></video>
                                <img class="d-none" src="" alt="" id="img-buffer" class="sticker-preview">
                                <!-- <video class="toggle-upload toggle-web" id="video" style="width: 100%" autoplay></video> -->
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class=" canvas-upload my-1 border-0 " id="canvas-stickers"></canvas> -->
                                    <canvas class=" canvas-upload my-1 border-0 " id="canvas-stickers"></canvas>
                                </div>
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class=" canvas-upload my-1 border-0 " id="canvas"></canvas> -->
                                    <canvas class="canvas-upload d-none my-1 border-0 " id="canvas"></canvas>
                                </div>
                                <!-- STICKERS -->
                                <div class="d-flex justify-content-center flex-wrap" id="description" style="width: 100%;">
                                    <div class="scrollmenu bg-light my-0 mb-2 px-2" style="width: 100%;">
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

                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload toggle-web d-none" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2 d-none toggle-web1" id="btn-shot" type="button" disabled>Select Sticker</button>
                                <button class="btn btn-sm btn-dark post-btn m-2 d-none toggle-upload toggle-web2" id="btn-post" type="button">Post</button>
                                <div class="or">OR</div>
                                <button class="btn btn-sm btn-danger post-btn m-2 d-none toggle-upload toggle-web1" id="btn-cancel" type="reset">Cancel</button>
                                <button class="btn btn-sm btn-danger post-btn m-2 d-none toggle-web2" id="btn-retry" type="button">Retry</button>
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
    const image_input = document.querySelector("#pic-upload");
    let pic = new Image(); // Create new pic element
    //const pic = document.getElementById("img-buffer");; // Create new pic element
    const video = document.querySelector("#video");
    const button_cancel = document.getElementById('btn-cancel');
    const button_post = document.getElementById('btn-post');
    const button_webcam = document.querySelector("#open_web");
    const button_shot = document.querySelector("#btn-shot");
    const button_retry = document.querySelector("#btn-retry");
    let selected_stickers = {};

    //UPLOAD PICTURE PART
    image_input.addEventListener("change", function() {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            pic.src = uploaded_image;
        });
        reader.readAsDataURL(this.files[0]);
    });

    pic.addEventListener('load', () => {
        set_canvas_dimentions();
        draw_to_imgBuffer();
        draw_to_preview();
        adjust_decription(pic.naturalWidth + 2);
        display_by_class('toggle-upload');
        hide_by_class('btns-menu');

    }, false);

    //WEBCAM PHOTO PART
    button_webcam.addEventListener('click', (ev) => {
        webcam_start();
        ev.preventDefault();
    });

    video.addEventListener('canplay', (ev) => {
        toggle_by_class('toggle-loader');
        hide_by_class('btns-menu');
        display_by_class('toggle-web');
        display_by_class('toggle-web1');

        set_canvas_dimentions();
        adjust_decription(video.videoWidth + 2);

    }, false);

    video.addEventListener('play', () => {
        (function loop() {
            if (video.paused)
                return;
            draw_to_imgBuffer();
            draw_to_preview();
            console.log(1);
            setTimeout(loop, 1000 / 60); //16fps
        })();
    }, false);

    button_shot.addEventListener('click', (ev) => {
        takepicture();
        ev.preventDefault();
    }, false);

    button_retry.addEventListener('click', (ev) => {
        retry();
        ev.preventDefault();
    }, false);

    // STICKERS HANDLING
    function selectSticker(sticker_id) {
        let s_name = 'stick' + sticker_id;
        let sticker = document.getElementById('stick' + sticker_id);

        if (s_name in selected_stickers) {
            delete selected_stickers[s_name];
            sticker.classList.remove('selected');
        } else {
            sticker.classList.add('selected');
            let s_sticker = {
                'img': sticker,
                'x': 20,
                'y': 50
            }
            selected_stickers[s_name] = s_sticker;
        }

        if (Object.keys(selected_stickers).length > 0) {
            button_shot.disabled = false;
            button_shot.innerHTML = "Take Photo";
            button_post.disabled = false;
            button_post.innerHTML = "Post";
        } else {
            if (video.srcObject && !pic.src) {
                button_post.disabled = true;
                button_post.innerHTML = "Select Stickers";
            } else {
                button_post.disabled = false;
                button_post.innerHTML = "Post";
            }
            button_shot.disabled = true;
            button_shot.innerHTML = "Select Stickers";
        }
        draw_to_preview();
    }

    // function removePreview(stickerId) {
    // 	selectedStickers = selectedStickers.filter(s => s !== stickerId);
    // 	previewSelected();
    // }
    //VIDO IS BEING STREAMED AND CTX IS REVRITTEN BY SECINDS, MEANING, THAT STICKERS SHOUKD TOO!

    //CANCEL, POST BUTTONS 

    button_cancel.addEventListener("click", function() {
        //turn off webcam here
        reset_all();
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
</script>

<!-- Helpers functions -->
<script>
    async function webcam_start() {
        navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            })
            .then((stream) => {
                video.srcObject = stream;
                video.play();
            })
            .catch((err) => {
                console.error(`An error occurred: ${err}`);
            });
        toggle_by_class('toggle-loader');
    }

    function takepicture() {
        hide_by_class('toggle-web1')
        display_by_class('toggle-web2');

        draw_to_imgBuffer();
        draw_to_preview();

        stop_webcam();

        adjust_decription(video.videoWidth + 2);

        // data url of the image
        let image_data_url = canvas.toDataURL('image/jpeg');
        console.log(image_data_url);
    };

    function retry() {
        clear_canvases();
        hide_by_class('toggle-web2');
        display_by_class('toggle-web1');
        webcam_start();
    };


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

    function display_by_class(class_name) {
        const boxes = document.getElementsByClassName(class_name);

        for (const box of boxes) {
            box.classList.remove('d-none');
        }
    }

    function hide_by_class(class_name) {
        const boxes = document.getElementsByClassName(class_name);

        for (const box of boxes) {
            box.classList.add('d-none');
        }
    }

    function clear_canvases() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx_stickers.clearRect(0, 0, canvas.width, canvas.height);
    }

    function reset_stickers() {
        Object.keys(selected_stickers).forEach((key) => {
            let sticker = selected_stickers[key]['img'];
            sticker.classList.remove('selected');
        });
        selected_stickers = {};
    }

    function reset_all() {

        if (video.srcObject) {
            stop_webcam();
        }
        //console.log(pic.src);
        //console.log(pic);
        if (pic.src && pic.src != window.location.href) {
            pic.src = "";
        }
        reset_stickers();
        clear_canvases();
        hide_by_class('toggle-web');
        hide_by_class('toggle-web1');
        hide_by_class('toggle-web2');
        hide_by_class('toggle-upload');
        display_by_class('btns-menu');
    }

    function draw_to_preview() {
        ctx_stickers.drawImage(canvas, 0, 0);
        draw_stickers();
    }

    function draw_to_imgBuffer() {
        if (pic.src && pic.src != window.location.href) {
            ctx.drawImage(pic, 0, 0);
        } else if (video.srcObject && !video.paused) {
            ctx.drawImage(video, 0, 0);
        }
    }

    function set_canvas_dimentions() {
        if (pic.src && pic.src != window.location.href) {
            canvas.width = pic.naturalWidth;
            canvas.height = pic.naturalHeight;
            canvas_stickers.width = pic.naturalWidth;
            canvas_stickers.height = pic.naturalHeight;
        } else if (video.srcObject && !video.paused) {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas_stickers.width = video.videoWidth;
            canvas_stickers.height = video.videoHeight;
        }
    }

    function draw_stickers() {
        for (const key in selected_stickers) {
            if (selected_stickers.hasOwnProperty(key)) {
                ctx_stickers.drawImage(selected_stickers[key]['img'], selected_stickers[key]['x'], selected_stickers[key]['y']);
            }
        }
    }

    function stop_webcam() {
        video.pause();
        tracks = video.srcObject.getTracks();
        tracks.forEach(function(track) {
            track.stop();
        });
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