<?php
$this->setVar('title', 'Change Password');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-primary" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-2" style="max-width: 400px;">
        <?php echo $this->include('_templates/header'); ?>
        <?php if (isset($this->data['error'])) :
            echo $this->include('_templates/errors');
        endif; ?>
        <form action="/auth/change-password" method="post" class="d-block col-12">
            <div class="mb-4">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required>
            </div>
            <div class="mb-2">
                <button class="btn btn-lg btn-primary mt-2 w-100" type="submit">Change Password</button>
            </div>
        </form>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>