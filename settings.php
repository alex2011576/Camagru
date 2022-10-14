<?php
require __DIR__ . '/src/bootstrap.php';
require __DIR__ . '/src/settings.php';
?>

<?php view('header_logged', ['title' => 'Settings']) ?>
<?php flash() ?>

<?php if (isset($errors['password'])) : ?>
    <div class="alert alert-danger">
        <?= $errors['password'] ?>
    </div>
<?php elseif (isset($errors) && !empty($errors)) : ?>
    <div class="alert alert-danger">
        <?= "Wrong input, try again!" ?>
    </div>
<?php endif; ?>

<main class="">

    <div class="container-fluid forms-container d-flex flex-column ">
        <!-- Notification settings -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 mt-3 mb-2" method="post">
            <p class="h5 text-center fw-normal my-2">Notifications Settings</p>
            <div class="d-grid pt-3 pb-2">
                <button class="btn btn-dark" type="button" id=btn-unsub onclick="subcription_change(2)" <?= ($inputs['sub'] === 2 ? "disabled" : '') ?>>Unsubscribe</button>
            </div>
            <div class="d-grid pt-3 pb-2">
                <button class="btn btn-dark" type="button" id="btn-sub" onclick="subcription_change(1)" <?= ($inputs['sub'] === 1 ? "disabled" : '') ?>>Subscribe</button>
            </div>
        </form>
        <!-- Change Email-->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2" method="post">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Email</p>
            <div class="row mb-3">
                <!-- <label for="" class="col-form-label">New Email</label> -->
                <div class="">
                    <input type="email" name="new_email" autocomplete="on" class="form-control bg-light" maxlength="50" placeholder="New email" aria-label="New Email" required>
                </div>
                <small class="text-danger"><?= $errors['new_email'] ?? '' ?></small>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" class="form-control bg-light" placeholder="Password" aria-label="Password" required>
                </div>

            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" name="change_email" value="change_email" type="submit">Submit</button>
            </div>
        </form>
        <!-- Change Username -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2" method="post">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Username</p>
            <div class="row mb-3">
                <div class="">
                    <input type="text" name="new_username" class="form-control bg-light" title="Username should be 3-15 characters, no spaces allowed." pattern="^(?!.*\s)(\w|\W){3,15}$" placeholder="New Username" aria-label="New Username" required>
                </div>
                <small class="text-danger"><?= $errors['new_username'] ?? '' ?></small>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" class="form-control bg-light" placeholder="Password" aria-label="Add comment" required>
                </div>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" name="change_username" value="change_username" type="submit">Submit</button>
            </div>
        </form>
        <!-- Change Password -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2" method="post">
            <p class="h5 text-center fw-normal mt-2 mb-3">Change Password</p>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" autocomplete="on" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,200}" placeholder="Old Password" aria-label="Old Password" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="new_password" autocomplete="on" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,200}" placeholder="New Password" aria-label="New Password"  required>
                </div>
                <small class="text-danger"><?= $errors['new_password'] ?? '' ?></small>
            </div>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="new_password2" autocomplete="on" class="form-control bg-light" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,200}" placeholder="Confirm New Password" aria-label="Confirm New Password" required>
                </div>
                <small class="text-danger"><?= $errors['new_password2'] ?? '' ?></small>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-dark p-1" name="change_password" value="change_password" type="submit">Submit</button>
            </div>
        </form>
        <!-- Delete Account -->
        <form class="form-container border border-light shadow-sm  px-4 py-3 my-2" method="post">
            <p class="h5 text-center fw-normal mt-2 mb-3">Delete Account</p>
            <div class="row mb-3">
                <div class="">
                    <input type="password" name="password" class="form-control bg-light" placeholder="Confirm With Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" aria-label="Confirm With Password" aria-describedby="" autocomplete="on" required>
                </div>
            </div>
            <div class="d-grid pt-2 pb-2">
                <button class="btn btn-danger p-1" name="delete_account" value="delete_account" type="submit">Submit</button>
            </div>
        </form>
    </div>
</main>

<?php view('footer') ?>

<script>
    const btn_sub = document.getElementById("btn-sub");
    const btn_unsub = document.getElementById("btn-unsub");

    function subcription_change(num) {

        const formData = new FormData();
        const parsedUrl = new URL(window.location.href);
        btn_sub.disabled = true;
        btn_unsub.disabled = true;
        formData.append('sub', num);
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
                    if (num == 1) {
                        btn_unsub.disabled = false;
                    } else if (num == 2) {
                        btn_sub.disabled = false;
                    }
                }
            })
            .catch((error) => {
                alert('Error:', error);
            });
    }
</script>