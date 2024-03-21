<?php
extract($this->data);
$this->setVar('title', 'Login');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-primary" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-2" style="max-width: 400px;">
        <?= $this->include('_templates/header'); ?>
        <?= $this->include('_templates/alerts'); ?>
        <form action="/auth/login" method="post" class="d-block col-12">
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= $old('username') ?>" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="mb-2">
                <button class="btn btn-lg btn-primary mt-2 w-100" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>