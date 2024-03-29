<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/new_post.php';
?>

<?php view('header_logged', ['title' => 'New Post']) ?>
<?php flash() ?>

<main class="" style="width: 100%">


    <div class="container-fluid d-flex justify-content-center ">
        <!-- Modal  -->
        <div id="loading_modal" class="modal_loader d-flex justify-content-center align-items-center">
            <div class="modal-content d-flex justify-content-center  align-items-center">
                <div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="container mt-2 p-0 mx-0 mx-md-3 page-wrapper">
            <div class="row g-5">
                <div class="col-12 col-md-8">
                    <div class="p-0 p-md-3  border shadow-sm rounded-0 bg-light">
                        <form class="d-flex justify-content-center flex-wrap" method="POST" enctype="multipart/form-data" id="form_upload">

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
                            <!-- Modal  -->
                            <div id="loading_modal" class="modal_loader d-flex justify-content-center align-items-center d-none">
                                <div class="modal-content d-flex justify-content-center  align-items-center">
                                    <div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <!-- CANVAS -->
                            <div class="d-flex justify-content-center flex-wrap m-1 toggle-upload toggle-web d-none " style="width: 100%">
                                <video class="d-none" id="video" style="width: 100%" autoplay></video>
                                <!-- <img class="d-none" src="" alt="" id="img-buffer" class="sticker-preview"> -->
                                <!-- <video class="toggle-upload toggle-web" id="video" style="width: 100%" autoplay></video> -->
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class=" canvas-upload my-1 border-0 " id="canvas-stickers"></canvas> -->
                                    <canvas class=" canvas-upload my-1 border-0" id="canvas-stickers"></canvas>
                                </div>
                                <div class="d-flex justify-content-center" style="width: 100%;">
                                    <!-- <canvas class="canvas-upload d-none my-1 border-0 " id="canvas"></canvas> -->
                                    <canvas class="canvas-upload d-none my-1 border-0 " id="canvas"></canvas>
                                </div>
                                <!-- STICKERS -->
                                <div class="d-flex justify-content-center flex-wrap" id="description" style="width: 100%;">
                                    <div class="scrollmenu bg-light my-0 mb-2 px-2" style="width: 100%;">
                                        <img class="sticker" id="stick1" onclick="selectSticker(1)" src="./static/stickers/1.png" alt="">
                                        <img class="sticker" id="stick2" onclick="selectSticker(2)" src="./static/stickers/2.png" alt="">
                                        <img class="sticker" id="stick3" onclick="selectSticker(3)" src="./static/stickers/3.png" alt="">
                                        <img class="sticker" id="stick4" onclick="selectSticker(4)" src="./static/stickers/4.png" alt="">
                                        <img class="sticker" id="stick5" onclick="selectSticker(5)" src="./static/stickers/5.png" alt="">
                                        <img class="sticker" id="stick6" onclick="selectSticker(6)" src="./static/stickers/6.png" alt="">
                                        <img class="sticker" id="stick7" onclick="selectSticker(7)" src="./static/stickers/7.png" alt="">
                                        <img class="sticker" id="stick8" onclick="selectSticker(8)" src="./static/stickers/8.png" alt="">
                                        <img class="sticker" id="stick9" onclick="selectSticker(9)" src="./static/stickers/9.png" alt="">
                                        <img class="sticker" id="stick10" onclick="selectSticker(10)" src="./static/stickers/10.png" alt="">
                                        <img class="sticker" id="stick11" onclick="selectSticker(11)" src="./static/stickers/11.png" alt="">
                                        <img class="sticker" id="stick12" onclick="selectSticker(12)" src="./static/stickers/12.png" alt="">
                                        <img class="sticker" id="stick13" onclick="selectSticker(13)" src="./static/stickers/13.png" alt="">
                                        <img class="sticker" id="stick14" onclick="selectSticker(14)" src="./static/stickers/14.png" alt="">
                                        <img class="sticker" id="stick15" onclick="selectSticker(15)" src="./static/stickers/15.png" alt="">
                                        <img class="sticker" id="stick16" onclick="selectSticker(16)" src="./static/stickers/16.png" alt="">
                                    </div>
                                    <input type="text" class="form-control my-1 border-0 rounded-0" name="description" id="description-input" value="" maxlength="200" placeholder="Add description: " autocomplete="off" />
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center m-1 toggle-upload toggle-web d-none" style="width: 100%">
                                <button class="btn btn-sm btn-dark post-btn m-2 d-none toggle-web1" id="btn-shot" type="button" disabled>Select Sticker</button>
                                <button class="btn btn-sm btn-dark post-btn m-2 d-none toggle-upload toggle-web2" id="btn-post" type="button">Post</button>
                                <div class="or">OR</div>
                                <button class="btn btn-sm btn-danger post-btn m-2 d-none toggle-upload toggle-web1" id="btn-cancel" type="reset">Cancel</button>
                                <button class="btn btn-sm btn-danger post-btn m-2 d-none toggle-web2" id="btn-retry" type="button">Retry</button>
                            </div>

                            <div class="bg-light">

                            </div>
                        </form>
                    </div>
                </div>
                <!-- Thumbnail -->
                <div class="col-12 col-md-4 border bg-light p-3">
                    <!-- <div class="p-1 border bg-white d-flex justify-content-center"> -->
                    <div class="p-1 d-flex justify-content-center">
                        <p class="text text-center thumb-title fw-bold" style="width: inherit">
                            Previously posted
                        </p>
                    </div>
                    <div class="d-flex d-wrap justify-content-center  align-items-center p-1 mb-2 border bg-white thumb-loader d-none" style="width:100%">
                        <!-- <p style="width:100%">Uploading your post</p> -->
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="thumbnail" id="thumbnail" style="width:100%">
                        <?php if (isset($inputs['thumbnail']) && !empty($inputs['thumbnail'])) : ?>
                            <?php foreach ($inputs['thumbnail'] as $post => $value) { ?>
                                <div class="border m-1 thumbnail-div" data-post-id=" <?= $value['post_id'] ?>">
                                    <button href="#" class="btn pic-btn delete-button border border-dark" onclick="delete_post(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                                        </svg>
                                    </button>
                                    <img src="<?= $value['post'] ?>" style="width:100%">
                                </div>

                            <?php } ?>
                            <div class="alert d-none no-posts-alert">
                                <?= "You didn't post anything yet! :)" ?>
                            </div>
                        <?php else : ?>
                            <div class="alert no-posts-alert">
                                <?= "You didn't post anything yet! :)" ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center">
                    </div>
                    <button href="#" class="btn pic-btn d-none delete-button-template">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16" color="black">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

</main>

<?php view('footer') ?>
<!-- EVENT HANDLERS script -->
<script>
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const canvas_stickers = document.getElementById("canvas-stickers");
    const ctx_stickers = canvas_stickers.getContext("2d");
    const image_input = document.querySelector("#pic-upload");
    let pic = new Image();
    const video = document.querySelector("#video");
    const button_cancel = document.getElementById('btn-cancel');
    const button_post = document.getElementById('btn-post');
    const button_webcam = document.querySelector("#open_web");
    const button_shot = document.querySelector("#btn-shot");
    const button_retry = document.querySelector("#btn-retry");
    let dispay_mode = "0";
    let last_frame;
    let last_sticker;
    let selected_stickers = {};

    window.onload = function() {
        //display_by_class('page-wrapper');
        hide_by_class('modal_loader');
    }

    //UPLOAD PICTURE PART
    image_input.addEventListener("change", function() {
        const reader = new FileReader();
        if (this.files[0].size > 4 * 1024 * 1024) {
            alert("File is too big! Maximum size is 4Mb");
            this.value = "";
        } else {
            reader.addEventListener("load", () => {
                const uploaded_image = reader.result;

                if (isImage(uploaded_image)) {
                    testImage(uploaded_image)
                        .then(() => {
                            pic.src = uploaded_image;
                        })
                        .catch(() => {
                            alert("Corrupt file!");
                        });

                } else {
                    alert("Wrong file format! Only jpeg and png are accepted!");
                }

            });
            reader.readAsDataURL(this.files[0]);
        }
    });

    pic.addEventListener('load', () => {
        // canvas.style = "transform: scaleX(1);"
        // canvas_stickers.style = "transform: scaleX(1);"
        dispay_mode = "2";
        set_canvas_dimentions();
        draw_to_imgBuffer();
        draw_to_preview();
        adjust_decription(pic.naturalWidth + 2);
        display_by_class('toggle-upload');
        hide_by_class('btns-menu');

    }, false);

    //WEBCAM PHOTO PART
    button_webcam.addEventListener('click', (ev) => {
        button_webcam.disabled = true;
        image_input.disabled = true;
        dispay_mode = "1";
        webcam_start();
        ev.preventDefault();
    });

    video.addEventListener('canplay', (ev) => {
        //canvas.style = "transform: scaleX(-1);"
        //canvas_stickers.style = "transform: scaleX(-1);"
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
        let s_name = sticker_id;
        //let s_name = 'stick' + sticker_id;
        let sticker = document.getElementById('stick' + sticker_id);
        last_frame = canvas_stickers;
        if (s_name in selected_stickers) {
            if (s_name === last_sticker)
                last_sticker = 'lost_track';
            delete selected_stickers[s_name];
            sticker.classList.remove('selected');
        } else {
            last_sticker = s_name;
            sticker.classList.add('selected');
            let s_sticker = {
                'img': sticker,
                'x': (canvas.width / 2) - (sticker.naturalWidth / 2),
                'y': canvas.height / 2
            }
            selected_stickers[s_name] = s_sticker;
        }

        if (Object.keys(selected_stickers).length > 0) {
            button_shot.disabled = false;
            button_shot.innerHTML = "Take Photo";
            button_post.disabled = false;
            button_post.innerHTML = "Post";
        } else {
            if (video.srcObject && (!pic.src || pic.src == window.location.href)) {
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

    canvas_stickers.addEventListener('mousedown', function(evt) {
        if (Object.keys(selected_stickers).length == 0)
            return;
        if (!selected_stickers.hasOwnProperty(last_sticker))
            return;
        let coords = getMousePos(canvas_stickers, evt);
        coords.x = coords.x - selected_stickers[last_sticker]['img'].naturalWidth / 2;
        coords.y = coords.y - selected_stickers[last_sticker]['img'].naturalHeight / 2;

        selected_stickers[last_sticker]['x'] = coords.x;
        selected_stickers[last_sticker]['y'] = coords.y;
        let sticker = selected_stickers[last_sticker];
        draw_to_preview();
        //draw_stickers();
        //ctx_stickers.drawImage(sticker['img'], coords.x, coords.y);
    })

    //CANCEL, POST BUTTONS 
    button_cancel.addEventListener("click", function() {
        //turn off webcam here
        reset_all();
    });

    button_post.addEventListener("click", function() {
        this.disabled = true;
        const formData = new FormData();
        let image_data_url = canvas.toDataURL('image/jpeg');
        let description = document.getElementById("description-input").value;
        let stickers = {};
        for (const key in selected_stickers) {
            if (selected_stickers.hasOwnProperty(key)) {
                let k_sticker = {
                    'x': selected_stickers[key]['x'],
                    'y': selected_stickers[key]['y']
                }
                stickers[key] = k_sticker;
            }
        }
        formData.append('stickers', JSON.stringify(stickers));
        //formData.append('description', JSON.stringify(description));
        formData.append('description', description);
        formData.append('image', image_data_url);
        if (dispay_mode === "1") {
            formData.append('flip', "1");
        }

        const parsedUrl = new URL(window.location.href);
        fetch(parsedUrl, {
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
                if (result.hasOwnProperty('error')) {
                    alert(result.error);
                } else if (result.hasOwnProperty('success')) {
                    alert(result.success);
                    appendPhoto_thumbnail(result.image);
                }
                //hide_by_class("modal_loader");
                //appendPhotoBar(result);
                //maybe add alert when loaded
                hide_by_class("thumb-loader");
            })
            .catch((error) => {
                alert('Error:', error);
                hide_by_class("thumb-loader");
            });
        let modal = document.getElementById("loading_modal");
        //display_by_class("modal_loader");
        reset_all();
        display_by_class("thumb-loader");
        //alert :your post is being processed
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
                alert(`An error occurred: ${err}`);
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
        // let image_data_url = canvas.toDataURL('image/jpeg');
        // console.log(image_data_url);
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

    // function toggle_by_class(class_name) {
    //     const boxes = document.getElementsByClassName(class_name);

    //     for (const box of boxes) {
    //         box.classList.toggle('d-none');
    //     }
    // }

    // function display_by_class(class_name) {
    //     const boxes = document.getElementsByClassName(class_name);

    //     for (const box of boxes) {
    //         box.classList.remove('d-none');
    //     }
    // }

    // function hide_by_class(class_name) {
    //     const boxes = document.getElementsByClassName(class_name);

    //     for (const box of boxes) {
    //         box.classList.add('d-none');
    //     }
    // }

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
        document.getElementById('form_upload').reset();
        reset_stickers();
        clear_canvases();
        hide_by_class('toggle-web');
        hide_by_class('toggle-web1');
        hide_by_class('toggle-web2');
        hide_by_class('toggle-upload');
        display_by_class('btns-menu');
        button_post.disabled = false;
        button_webcam.disabled = false;
        image_input.disabled = false;
        button_shot.disabled = true;
        button_shot.innerHTML = "Select Stickers";
    }

    function draw_to_preview() {
        ctx_stickers.clearRect(0, 0, canvas.width, canvas.height);
        if (dispay_mode === "1") {
            mirrorImage(ctx_stickers, canvas, 0, 0, true, false); // horizontal mirror
        } else {
            ctx_stickers.drawImage(canvas, 0, 0);
        }
        draw_stickers();
    }

    function draw_to_imgBuffer() {
        if (pic.src && pic.src != window.location.href) {
            ctx.drawImage(pic, 0, 0);
        } else if (video.srcObject && !video.paused) {
            ctx.drawImage(video, 0, 0);
        }
    }

    function mirrorImage(ctx, image, x = 0, y = 0, horizontal = false, vertical = false) {
        ctx.save(); // save the current canvas state
        ctx.setTransform(
            horizontal ? -1 : 1, 0, // set the direction of x axis
            0, vertical ? -1 : 1, // set the direction of y axis
            x + (horizontal ? image.width : 0), // set the x origin
            y + (vertical ? image.height : 0) // set the y origin
        );
        ctx.drawImage(image, 0, 0);
        ctx.restore(); // restore the state as it was when this function was called
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

    function getMousePos(canvas_stickers, evt) {
        let rect = canvas_stickers.getBoundingClientRect();
        return {
            x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
            y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
        };
    }

    function isImage(url) {
        return /^data:image\/(jpg|jpeg|png|webp|avif|gif|svg)/.test(url);
    }

    //insertBerofe, .firstChild best for browser support 
    function appendPhoto_thumbnail(savedImage) {
        let thumbnail = document.getElementById('thumbnail');
        let div = document.createElement('div');
        let latest_photo = document.createElement('img');
        let button_delete = get_delete_button();
        //let wrapper = document.createElement('img');
        // wrapper.classList.add("")
        div.style.maxWidth = "100%";
        div.classList.add("border", "my-1", "thumbnail-div");
        latest_photo.style.maxWidth = "100%";
        //latest_photo.classList.add("border", "my-1");
        div.setAttribute('data-post-id', savedImage.post_id);
        latest_photo.src = savedImage.url;
        thumbnail.insertBefore(div, thumbnail.firstChild);
        thumbnail.firstChild.insertBefore(latest_photo, thumbnail.firstChild.firstChild);
        thumbnail.firstChild.insertBefore(button_delete, thumbnail.firstChild.firstChild);
        //display_by_class('thumbnail');
        hide_by_class('no-posts-alert');
        //thumbnail.appendChild(latest_photo);
    }

    function get_delete_button() {
        let button_d = document.getElementsByClassName('delete-button-template');
        let clone = button_d[0].cloneNode(true);
        clone.classList.add('delete-button', 'border', 'border-dark');
        clone.classList.remove('delete-button-template', 'd-none');
        clone.setAttribute('onclick', 'delete_post(this)');
        return clone;
    }

    function delete_post(t_element) {
        let id = t_element.parentElement.getAttribute('data-post-id');
        const parsedUrl = new URL(window.location.href);
        const formData = new FormData();
        t_element.parentElement.classList.add('d-none');
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
                    t_element.parentElement.classList.remove('d-none');
                } else if (result.hasOwnProperty('success')) {
                    //alert(result.success);
                    if (t_element.parentElement.parentElement.childElementCount === 2) {
                        display_by_class('no-posts-alert');
                    }
                    //console.log(t_element.parentElement.parentElement.childElementCount);
                    t_element.parentElement.remove();
                }
                // console.log(result);
            })
            .catch((error) => {
                // console.error('Error:', error);
                alert('Error:', error);
                t_element.parentElement.classList.remove('d-none');
            });

    }

    function testImage(url) {

        // Define the promise
        const imgPromise = new Promise(function imgPromise(resolve, reject) {

            // Create the image
            const imgElement = new Image();

            // When image is loaded, resolve the promise
            imgElement.addEventListener('load', function imgOnLoad() {
                resolve(this);
            });

            // When there's an error during load, reject the promise
            imgElement.addEventListener('error', function imgOnError() {
                reject();
            })

            // Assign URL
            imgElement.src = url;

        });

        return imgPromise;
    }
</script>